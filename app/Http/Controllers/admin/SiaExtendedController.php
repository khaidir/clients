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
        $company = Companies::all();
        return view('admin.extended.index', compact('company'));
    }

    public function getData(Request $request)
    {
        $query = SiaExtended::select('sia_extended.*', 'companies.name as company', 'requester.name as request_by_name',
            'approver.name as approved_by_name', 'verifier.name as verified_by_name')
            ->leftJoin('users as requester', 'sia_extended.user_id', '=', 'requester.id')
            ->leftJoin('users as approver', 'sia_extended.approved_by', '=', 'approver.id')
            ->leftJoin('users as verifier', 'sia_extended.verified_by', '=', 'verifier.id')
            ->leftJoin('companies', 'sia_extended.company_id', '=', 'companies.id')
            ->orderBy('created_at','desc');

        if ($request->has('company')  && $request->company !== 'all') {
            $query->where('sia_extended.company_id', $request->company);
        }

        $extend = $query->get();

        $extend->transform(function ($row) {
            $type = [
                ''  => 'Pilih Tipe Kontrak',
                '1' => 'Contract',
                '2' => 'Purchase Request',
                '3' => 'Purchase Order'
            ];
            $row->contract = '<strong>'.$row->no_contract . '</strong><br>' . ($type[$row->type_contract] ?? '');
            $row->periode = Carbon::parse($row->periode_start)->format('d M, Y') .' - '. Carbon::parse($row->periode_end)->format('d M, Y');
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
            ->rawColumns(['action', 'contract', 'periode'])
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
            'periode_start' => 'required|string',
            'periode_end' => 'required|string',
        ],[
            'company_id.required' => 'Company is required',
            'type_contract.required' => 'Contract Type is required',
            'periode_start.required' => 'Periode start is required',
            'periode_end.required' => 'Periode End is required',
        ]);

        DB::beginTransaction();
        try {

            $company =  $request['company_id'] ?? null;
            $periode_start = $request['periode_start'] ?? null;
            $periode_end = $request['periode_end'] ?? null;
            $type_contract = $request['type_contract'] ?? null;
            $description_of_task = $request['description_of_task'] ?? null;
            $no_contract = $request['no_contract'] ?? null;
            $id = $request['id'] ?? null;
            $status = $request['status'] ?? null;

            $contract_data = [
                'company_id' => $company,
                'no_contract' => $no_contract,
                'type_contract' => $type_contract,
                'description_of_task' => $description_of_task,
                'periode_start' => $periode_start ? date('Y-m-d', strtotime($periode_start)) : null,
                'periode_end' => $periode_end ? date('Y-m-d', strtotime($periode_end)) : null,
            ];

            if (empty($id)) {
                $contract_data['requested_at'] = date('Y-m-d H:i:sP');
                $contract_data['user_id'] = Auth::id();
                $contract_data['sia_id'] = $dokumen->id;
            }

            $contract = SiaExtended::updateOrCreate([
                'id' => $id
            ], $contract_data);

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
        $data = SiaExtended::select('sia_extended.*', 'companies.id as company_id')
            ->leftJoin('companies', 'sia_extended.company_id', '=', 'companies.id')
            ->find($id);

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
