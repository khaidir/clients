<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;
use Auth;

class CompanyPublicController extends Controller
{
    public function index()
    {
        return view('public.company.index');
    }

    public function getData()
    {
        $company = Companies::select('companies.*')
            ->orderBy('created_at','desc')
            ->get();

        return DataTables::of($company)
            ->addColumn('action', function ($row) {
                return '
                    <a class="btn btn-sm btn-primary edit" href="/company/edit/' . $row->id . '"><i class="bx bx-pencil"></i></a>
                    <a class="btn btn-sm btn-danger delete" data-id="'.$row->id.'" href="javascript:void(0);"><i class="bx bxs-trash"></i></a>
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
        return view('public.company.form', compact('industries'));
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

            if ( @$request->id == '' ) {
                $request['user_id'] = Auth::id();
            }

            $dokumen = Companies::updateOrCreate([
                'id' => @$request->id
            ], @$request->all());

            DB::commit();
            return redirect()->route('public.company.index')->with(['success' => 'Data has been saved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('public.company.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('public.company.index')->with(['error' => @$e->getMessage()]);
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
        $data = Companies::find($id);
        return view('public.company.form', compact('data', 'industries'));
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $sia = Companies::find($id);
            $sia->delete();

            DB::commit();
            return redirect()->route('public.company.index')->with(['success' => 'Data delete successfully']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('public.company.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('publi.company.index')->with(['danger' => @$e->getMessage()]);
        }

    }
}
