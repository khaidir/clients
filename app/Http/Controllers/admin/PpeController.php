<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Ppe;
use App\Models\PpeType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;
use Auth;

class PpeController extends Controller
{
    public function index()
    {
        return view('admin.ppe.index');
    }

    public function getData($id = null)
    {
        $company = Ppe::select('*')
            ->orderBy('status','desc')
            ->orderBy('code','asc')
            ->where('type_id', $id)
            ->get();

        return DataTables::of($company)
            ->addColumn('action', function ($row) {
                return '
                    <a class="btn btn-sm btn-primary edit" href="/ppe/unit/edit/' . $row->id . '"><i class="bx bx-pencil"></i></a>
                    <a class="btn btn-sm btn-danger delete" data-id="'.$row->id.'" href="javascript:void(0);"><i class="bx bxs-trash"></i></a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create($id = null)
    {
        $ppe_type = PpeType::select('id')->find($id);
        return view('admin.ppe.form', $ppe_type);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'merk' => 'nullable|string',
            'colour' => 'nullable|string',
            'condition' => 'nullable|string',
            'notes' => 'nullable|string',
            'status' => 'boolean',
        ],[
            'code.required' => 'Code is required',
        ]);

        DB::beginTransaction();
        try {

            $ppe = Ppe::updateOrCreate([
                'id' => @$request->id
            ], @$request->all());

            DB::commit();
            return redirect()->route('unit.index', $request->type_id)->with(['success' => 'Data has been saved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('unit.index', $request->type_id)->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('unit.index', $request->type_id)->with(['error' => @$e->getMessage()]);
        }
    }

    public function edit($id = null)
    {
        $data = Ppe::find($id);
        return view('admin.ppe.form', compact('data'));
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $ppe = Ppe::find($id);
            $ppe->delete();

            DB::commit();
            return redirect()->route('unit.index', $ppe->type_id)->with(['success' => 'Data delete successfully']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('unit.index', $ppe->type_id)->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('unit.index', $ppe->type_id)->with(['danger' => @$e->getMessage()]);
        }

    }
}
