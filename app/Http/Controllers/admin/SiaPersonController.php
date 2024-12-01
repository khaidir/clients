<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Sia_person;
use App\Models\Companies;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;
use Auth;

class SiaPersonController extends Controller
{
    public function index()
    {
        return view('admin.new-worker-person.index');
    }

    public function getData($id)
    {
        $sia = Sia_person::select('sia_person.*')
            ->where('sia_id', $id)
            ->get();

        return DataTables::of($sia)
            ->addColumn('action', function ($row) {
                return '
                    <a class="btn btn-sm btn-primary edit" href="/worker/person/edit/' . $row->id . '"><i class="bx bx-pencil"></i></a>
                    <a class="btn btn-sm btn-success edit" href="/worker/person/detail/' . $row->id . '">Detail</a>
                    <a class="btn btn-sm btn-danger delete" data-id="'.$row->id.'" href="javascript:void(0);"><i class="bx bxs-trash"></i></a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function detail($id = null)
    {
        $data = Sia_person::select('*')
            // ->leftJoin('users', 'sia.user_id', '=', 'users.id')
            // ->leftJoin('companies', 'sia.company_id', '=', 'companies.id')
            ->find($id);

        return view('admin.new-worker-person.detail', compact('data', 'id'));
    }

    public function create($id = null)
    {
        return view('admin.new-worker-person.form', compact('id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_card' => 'nullable|string',
            'fullname' => 'required|string',
            'email' => 'required|string',
            'status' => 'boolean',
        ],[
            'fullname.required' => 'Fullname is required',
            'email.required' => 'Email is required',
        ]);


        DB::beginTransaction();
        try {

            $request['cert_expire'] = $request->cert_expire ? date('Y-m-d H:i:s', strtotime($request->cert_expire)) : null;

            $person = Sia_person::updateOrCreate([
                'id' => $request->id
            ], $request->only([
                'sia_id', 'id_card', 'fullname', 'email', 'token', 'position', 'cert_expire',
                'bpjs_number', 'score_induction', 'ktp', 'ktp_checked', 'card_id', 'card_checked',
                'passport', 'pp_checked', 'bpjs', 'bpjs_checked', 'contract', 'ct_checked',
                'cert_competence', 'cc_checked', 'medical_checkup', 'mc_checked', 'license_driver',
                'ld_checked', 'license_vaccinated', 'lv_checked', 'user_id', 'status', 'post'
            ]));

            DB::commit();
            return redirect()->route('sia.detail', @$request->sia_id)->with(['success' => 'Data has been saved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('sia.detail', @$request->sia_id)->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('sia.detail', @$request->sia_id)->with(['error' => @$e->getMessage()]);
        }
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            // $file->storeAs('public/uploads', $filename);
            $file->storeAs('uploads', $filename, 'public');

            return response()->json(['filename' => $filename, 'message' => 'File uploaded successfully'], 200);
        }

        return response()->json(['message' => 'File upload failed'], 400);
    }

    public function edit($id = null)
    {
        $data = Sia_person::find($id);
        return view('admin.new-worker-person.form', compact('data'));
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $sia = Sia_person::find($id);

            $sia->delete();

            DB::commit();
            return redirect()->route('sia.detail', $sia->sia_id)->with(['success' => 'Data delete successfully']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('sia.detail', $sia->sia_id)->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('sia.detail', $sia->sia_id)->with(['error' => @$e->getMessage()]);
        }

    }
}
