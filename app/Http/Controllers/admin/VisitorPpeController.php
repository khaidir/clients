<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorPpe;
use App\Models\Ppe;
use App\Models\Companies;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;
use Auth;

class VisitorPpeController extends Controller
{
    public function index()
    {
        return view('admin.visitor-person.index');
    }

    public function getData($id)
    {
        $ppe = VisitorPpe::select('visitor_ppe.*', 'ppe.code', 'ppe_type.goods')
            ->leftJoin('ppe', 'visitor_ppe.ppe_id', '=', 'ppe.id')
            ->leftJoin('ppe_type', 'ppe.type_id', '=', 'ppe_type.id')
            ->where('visitor_id', $id)
            ->get();

        $ppe->transform(function ($row) {
            $row->date_return = ($row->date_return == null) ? '<a href="/visitor/ppe/return/'.@$row->id.'" class="btn btn-success btn-sm">Return</a>': $row->date_return;
            $row->status = ($row->date_return == null) ? 'Not returned' : 'Has been returned';
            return $row;
        });

        return DataTables::of($ppe)
            ->addColumn('action', function ($row) {
                return '
                    <a class="btn btn-sm btn-primary edit" href="/visitor/ppe/edit/' . $row->id . '"><i class="bx bx-pencil"></i></a>
                    <a class="btn btn-sm btn-danger delete" data-id="'.$row->id.'" href="javascript:void(0);"><i class="bx bxs-trash"></i></a>
                ';
            })
            ->rawColumns(['action', 'date_return'])
            ->make(true);
    }

    public function create($id = null)
    {
        $ppes = Ppe::select('ppe.id', 'ppe.code', 'ppe_type.goods')
            ->leftJoin('ppe_type', 'ppe.type_id', '=', 'ppe_type.id')
            ->where('ppe.status', true)
            ->get();

        return view('admin.visitor.form-ppe', compact('id', 'ppes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ppe_id' => 'required|string',
            'date_pickup' => 'required|string',
            'status' => 'boolean',
        ],[
            'fullname.required' => 'Fullname is required',
            'email.required' => 'Email is required',
        ]);


        DB::beginTransaction();
        try {

            $request['date_pickup'] = date('Y-m-d H:i:s', strtotime(@$request->date_pickup));
            if( @$request->id ) {
                $request['date_return'] = @$request->id ? date('Y-m-d H:i:s', strtotime(@$request->date_return)) : null;
            }

            $person = VisitorPpe::updateOrCreate([
                'id' => $request->id
            ], $request->only([
                'ppe_id', 'visitor_id', 'date_pickup', 'notes', 'status'
            ]));

            Ppe::where('id', $request->ppe_id)->update(['status' => ($request->date_return) ? false : true]);

            DB::commit();
            return redirect()->route('visitor-ppe.index', @$request->visitor_id)->with(['success' => 'Data has been saved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('visitor-ppe.index', @$request->visitor_id)->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('visitor-ppe.index', @$request->visitor_id)->with(['error' => @$e->getMessage()]);
        }
    }

    public function edit($id = null)
    {
        $ppes = Ppe::select('ppe.id', 'ppe.code', 'ppe_type.goods')
            ->leftJoin('ppe_type', 'ppe.type_id', '=', 'ppe_type.id')
            ->where('ppe.status', true)
            ->get();

        $data = VisitorPpe::find($id);
        return view('admin.visitor.form-ppe', compact('data', 'ppes'));
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $person = VisitorPpe::find($id)->update($request->only([
                'date_return', 'status'
            ]));

            $person->delete();

            DB::commit();
            return redirect()->route('visitor-ppe.index', $person->visitor_id)->with(['success' => 'Data delete successfully']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('visitor-ppe.index', $person->visitor_id)->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('visitor-ppe.index', $person->visitor_id)->with(['error' => @$e->getMessage()]);
        }

    }

    public function goods_return($id)
    {

        DB::beginTransaction();
        try {

            $visitor_ppe = VisitorPpe::find($id);

            if ($visitor_ppe) {
                $visitor_ppe->date_return = date('Y-m-d H:i:s');
                $visitor_ppe->status = false;
                $visitor_ppe->save();
            }

            DB::commit();
            return redirect()->route('visitor-ppe.index', $visitor_ppe->visitor_id)->with(['success' => 'Data delete successfully']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('visitor-ppe.index', $visitor_ppe->visitor_id)->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('visitor-ppe.index', $visitor_ppe->visitor_id)->with(['error' => @$e->getMessage()]);
        }

    }
}
