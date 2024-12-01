<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\Sias;
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
        $extend = Extended::select('sia_extended.*',
            'approver.name as approved_by_name', 'verifier.name as verified_by_name')
            // ->leftJoin('users as requester', 'sia_extended.request_by', '=', 'requester.id')
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
        $contract = Sias::where('company_id', Auth::user()->company_id)->get();
        return view('public.extended.form', compact('contract'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sia_id' => 'required|string',
            'status' => 'boolean',
        ],[
            'sia_id.required' => 'Choose Contract Worker'
        ]);

        DB::beginTransaction();
        try {

            $request['company_id'] = Auth::user()->company_id;
            $request['user_id'] = Auth::user()->id;
            $request['request_by'] = Auth::user()->id;
            $request['requested_at'] = date('Y-m-d H:i:sP');
            $request['sia_id'] = $request->sia_id;

            $extended = Extended::updateOrCreate([
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
        $contract = Sias::where('company_id', Auth::user()->company_id)->get();
        $data = Extended::find($id);
        return view('public.extended.form', compact('data', 'contract'));
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $ex = Extended::find($id);
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
