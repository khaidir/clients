<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PpeType;
use App\Models\Ppe;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;
use Auth;

class PpeTypeController extends Controller
{
    public function index()
    {
        return view('admin.ppe-type.index');
    }

    public function getData()
    {
        $ppe_type = PpeType::select('ppe_type.*')
            ->orderBy('created_at','desc')
            ->get();

        $ppe_type->transform(function ($row) {
            $unit = Ppe::where('type_id', $row->id)->count();
            $row->units = $unit . ($unit > 1 ? ' Units' : ' Unit');
            return $row;
        });

        return DataTables::of($ppe_type)
            ->addColumn('action', function ($row) {
                return '
                    <a class="btn btn-sm btn-primary edit" href="/ppe/edit/' . $row->id . '"><i class="bx bx-pencil"></i></a>
                    <a class="btn btn-sm btn-success edit" href="/ppe/unit/' . $row->id . '"><i class="bx bx-detail"></i></a>
                    <a class="btn btn-sm btn-danger delete" data-id="'.$row->id.'" href="javascript:void(0);"><i class="bx bxs-trash"></i></a>
                ';
            })
            ->rawColumns(['action', 'units'])
            ->make(true);
    }

    public function units($id = null)
    {
        $data = PpeType::select('*')
            ->find($id);

        return view('admin.ppe-type.detail', compact('data', 'id'));
    }

    public function create()
    {
        return view('admin.ppe-type.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'goods' => 'required|string',
            'address' => 'nullable|string',
            'status' => 'nullable|boolean',
        ],[
            'goods.required' => 'Goods is required',
        ]);

        DB::beginTransaction();
        try {

            PpeType::updateOrCreate([
                'id' => @$request->id
            ], @$request->all());

            DB::commit();
            return redirect()->route('ppe.index')->with(['success' => 'Data has been saved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('ppe.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('ppe.index')->with(['error' => @$e->getMessage()]);
        }
    }

    public function edit($id = null)
    {
        $data = PpeType::find($id);
        return view('admin.ppe-type.form', compact('data'));
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $ppe_type = PpeType::find($id);
            $ppe_type->delete();

            DB::commit();
            return redirect()->route('ppe.index')->with(['success' => 'Data delete successfully']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('ppe.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('ppe.index')->with(['danger' => @$e->getMessage()]);
        }

    }
}
