<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SiaExtended;
use App\Models\Companies;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;
use Auth;

class SiaExtendedController extends Controller
{
    public function index()
    {
        return view('admin.extended.index');
    }

    public function getData()
    {
        $extend = SiaExtended::select('sia_extended.*', 'companies.name as company', 'requester.name as request_by_name',
            'approver.name as approved_by_name', 'verifier.name as verified_by_name')
            ->leftJoin('users as requester', 'sia_extended.request_by', '=', 'requester.id')
            ->leftJoin('users as approver', 'sia_extended.approved_by', '=', 'approver.id')
            ->leftJoin('users as verifier', 'sia_extended.verified_by', '=', 'verifier.id')
            ->leftJoin('companies', 'sia_extended.company_id', '=', 'companies.id')
            ->orderBy('created_at','desc')
            ->get();

        $extend->transform(function ($row) {
            $row->periode_start = Carbon::parse($row->periode_start)->format('d M, Y') .' - '. Carbon::parse($row->periode_end)->format('d M, Y');
            $row->requested_at = Carbon::parse($row->requested_at)->format('d M, Y');
            $row->type_contract = ($row->type_contract == 1) ? 'Lump Sum':'Volume Base';
            return $row;
        });

        return DataTables::of($extend)
            ->addColumn('action', function ($row) {
                return '
                    <a class="btn btn-sm btn-primary edit" href="/extend/edit/' . $row->id . '"><i class="bx bx-pencil"></i></a>
                    <a class="btn btn-sm btn-danger delete" data-id="'.$row->id.'" href="javascript:void(0);"><i class="bx bxs-trash"></i></a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $companies = Companies::all();
        return view('admin.extended.form', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|integer',
            'company_id' => 'required|integer',
            'type_contract' => 'required|string',
            'status' => 'nullable|boolean',
        ],[
            'company_id.required' => 'Company is required',
            'type_contract.required' => 'Contract is required',
        ]);

        DB::beginTransaction();
        try {

            if ( @$request->id == '' ) {
                $request['user_id'] = Auth::id();
            }

            $dokumen = SiaExtended::updateOrCreate([
                'id' => @$request->id
            ], @$request->all());

            DB::commit();
            return redirect()->route('extended.index')->with(['success' => 'Data has been saved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('extended.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('extended.index')->with(['error' => @$e->getMessage()]);
        }
    }

    public function edit($id = null)
    {
        $companies = Companies::all();
        $data = SiaExtended::find($id);
        return view('admin.extended.form', compact('data', 'companies'));
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $sia = SiaExtended::find($id);
            $sia->delete();

            DB::commit();
            return redirect()->route('extended.index')->with(['success' => 'Data delete successfully']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('extended.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('extended.index')->with(['danger' => @$e->getMessage()]);
        }

    }
}
