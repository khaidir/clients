<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\Sias;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;
use Auth;

class PublicContractsController extends Controller
{
    public function index()
    {
        return view('public.new-worker.contracts');
    }

    public function getData()
    {
        $sia = Sias::select(
            'sia.id',
            'sia.description',
            'sia.dete_request',
            'sia.status',
            'users.name as fullname',
            'companies.name as company',
            'sia_extended.description_of_task',
            'sia_extended.no_contract',
            'sia_extended.periode_start',
            'sia_extended.periode_end'
        )
        ->leftJoin('users', 'sia.user_id', '=', 'users.id')
        ->leftJoin('companies', 'sia.company_id', '=', 'companies.id')
        ->leftJoinSub(
            DB::table('sia_extended')
                ->select('id', 'sia_id', 'description_of_task', 'no_contract', 'periode_start', 'periode_end')
                ->whereRaw('id IN (SELECT MAX(id) FROM sia_extended GROUP BY sia_id)'),
            'sia_extended', 'sia.id', '=', 'sia_extended.sia_id'
        )
        ->get();


        $sia->transform(function ($row) {
            $row->periode = Carbon::parse($row->periode_start)->format('d M, Y') .'<br>'. Carbon::parse($row->periode_end)->format('d M, Y');
            $row->date_request = Carbon::parse($row->date_request)->format('d M, Y H:i');
            return $row;
        });

        return DataTables::of($sia)
            ->addColumn('action', function ($row) {
                return '
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a class="btn btn-sm btn-primary edit" href="/u/contracts/edit/' . $row->id . '"><i class="ki-outline ki-pencil fs-5 ms-1"></i></a>
                        <a class="btn btn-sm btn-warning edit" href="/u/contracts/workers/' . $row->id . '"><i class="ki-outline ki-document fs-5 ms-1"></i></a>
                    </div>
                ';
            })
            ->rawColumns(['action', 'periode', 'date_request'])
            ->make(true);
    }

    public function create()
    {
        return view('public.new-worker.form-contract');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description_of_task' => 'required|string',
            'status' => 'nullable|boolean',
        ],[
            'description_of_task.required' => 'Description of Task is required',
        ]);

        DB::beginTransaction();
        try {

            $company =  Auth::user()->company_id;
            $periode_start = $request['periode_start'] ?? null;
            $periode_end = $request['periode_end'] ?? null;
            $type_contract = $request['type_contract'] ?? null;
            $description_of_task = $request['description_of_task'] ?? null;
            $no_contract = $request['no_contract'] ?? null;
            $id = $request['id'] ?? null;
            $status = $request['status'] ?? null;

            $requestData = [
                'company_id' => $company,
                'description' => $description_of_task,
                'dete_request' => date('Y-m-d'),
                'status' => $status,
            ];

            $dokumen = Sias::updateOrCreate([
                'id' => $id
            ], $requestData);

            // contract data
            $contract_data = [
                'no_contract' => $no_contract,
                'type_contract' => $type_contract,
                'description_of_task' => $description_of_task,
                'periode_start' => $periode_start ? date('Y-m-d', strtotime($periode_start)) : null,
                'periode_end' => $periode_end ? date('Y-m-d', strtotime($periode_end)) : null,
            ];

            if (empty($id)) {
                $contract_data['user_id'] = Auth::id();
                $contract_data['sia_id'] = $dokumen->id;
            }

            $contract = SiaExtended::updateOrCreate([
                'id' => $id
            ], $contract_data);

            // personal data
            if (empty($id) && ($request->id_card != null && $request->email != null && $request->fullname != null) ) {
                $request['cert_expire'] = $request->cert_expire ? date('Y-m-d H:i:s', strtotime($request->cert_expire)) : null;
                $request['sia_id'] = $dokumen->id;
                $person = Sia_person::updateOrCreate([
                    'id' => $request->id
                ], $request->only([
                    'sia_id', 'id_card', 'fullname', 'email', 'token', 'position', 'cert_expire',
                    'bpjs_number', 'score_induction', 'ktp', 'ktp_checked', 'card_id', 'card_checked',
                    'passport', 'pp_checked', 'bpjs', 'bpjs_checked', 'contract', 'ct_checked',
                    'cert_competence', 'cc_checked', 'medical_checkup', 'mc_checked', 'license_driver',
                    'ld_checked', 'license_vaccinated', 'lv_checked', 'user_id', 'status', 'post'
                ]));
            }

            DB::commit();
            return redirect()->route('sia.index')->with(['success' => 'Data has been saved']);
        } catch (ValidationException $e) {
            DB::rollback();
            return redirect()->route('sia.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('sia.index')->with(['error' => @$e->getMessage()]);
        }
    }

    public function edit($id = null)
    {
        $company = Companies::all();
        $data = Sias::find($id);
        return view('admin.new-worker.form', compact('data', 'company'));
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $sia = Sias::find($id);

            $sia->delete();

            DB::commit();
            return redirect()->route('sia.index')->with(['success' => 'Data delete successfully']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('sia.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('sia.index')->with(['danger' => @$e->getMessage()]);
        }

    }

}
