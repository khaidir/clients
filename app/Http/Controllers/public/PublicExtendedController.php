<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\SiaExtended as Extended;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;
use Auth;

class PublicExtendedController extends Controller
{
    public function index()
    {
        return view('public.extended.index');
    }

    public function getData()
    {
        $extend = Extended::select('sia_extended.*', 'requester.name as request_by_name',
            'approver.name as approved_by_name', 'verifier.name as verified_by_name')
            ->leftJoin('users as requester', 'sia_extended.request_by', '=', 'requester.id')
            ->leftJoin('users as approver', 'sia_extended.approved_by', '=', 'approver.id')
            ->leftJoin('users as verifier', 'sia_extended.verified_by', '=', 'verifier.id')
            ->orderBy('created_at','desc')
            ->where('sia_extended.company_id', Auth::user()->company_id)
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
                    <a class="btn btn-sm btn-primary edit" href="/u/extended/edit/' . $row->id . '">
                        <i class="ki-outline ki-pencil fs-5 ms-1"></i>
                    </a>
                    <a class="btn btn-sm btn-danger delete" data-id="'.$row->id.'" href="javascript:void(0);">
                        <i class="ki-outline ki-trash fs-5 ms-1"></i>
                    </a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $industries = [
            'Technology',
            'Finance',
            'Healthcare',
            'Education',
            'Manufacturing',
            'Retail',
            'Transportation',
            'Agriculture',
            'Energy',
            'Construction',
            'Real Estate',
            'Hospitality',
            'Media',
            'Telecommunications'
        ];
        return view('public.extended.form', compact('industries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string',
            'address' => 'required|string',
            'phone' => 'nullable|string',
            'email' => 'required|string',
            'status' => 'boolean',
        ],[
            'name.required' => 'Company is required',
            'address.required' => 'Address is required',
            'email.required' => 'Email is required',
        ]);

        DB::beginTransaction();
        try {

            $dokumen = Extended::updateOrCreate([
                'id' => @$request->id
            ], @$request->all());

            DB::commit();
            return redirect()->route('public.extended')->with(['success' => 'Data has been saved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('public.extended')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('public.extended')->with(['error' => @$e->getMessage()]);
        }
    }

    public function edit($id = null)
    {
        $industries = [
            'Technology',
            'Finance',
            'Healthcare',
            'Education',
            'Manufacturing',
            'Retail',
            'Transportation',
            'Agriculture',
            'Energy',
            'Construction',
            'Real Estate',
            'Hospitality',
            'Media',
            'Telecommunications'
        ];
        $data = SiaExtended::find($id);
        return view('public.extended.form', compact('data', 'industries'));
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $ex = SiaExtended::find($id);
            $ex->delete();

            DB::commit();
            return redirect()->route('public.extended')->with(['success' => 'Data delete successfully']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('public.extended')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('public.extended')->with(['danger' => @$e->getMessage()]);
        }

    }
}
