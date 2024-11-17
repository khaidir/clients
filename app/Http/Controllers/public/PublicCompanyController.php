<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;
use Auth;

class PublicCompanyController extends Controller
{
    public function index()
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

        $data = Companies::select('companies.*')
            ->orderBy('created_at','desc')
            ->where('id', Auth::user()->company_id)
            ->first();

        return view('public.company.index', compact('data', 'industries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string',
            'address' => 'required|string',
            'phone' => 'nullable|string',
            'email' => 'required|string',
        ],[
            'name.required' => 'Company is required',
            'address.required' => 'Address is required',
            'email.required' => 'Email is required',
        ]);

        DB::beginTransaction();
        try {

            $company = Companies::where('id', Auth::user()->company_id)
                    ->update($request->only(['name', 'address', 'phone', 'email', 'industry', 'website']));

            DB::commit();
            return redirect()->route('public.company')->with(['success' => 'Data has been saved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('public.company')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('public.company')->with(['error' => @$e->getMessage()]);
        }
    }

}
