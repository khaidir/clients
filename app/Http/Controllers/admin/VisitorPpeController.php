<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorPpe;
use App\Models\Companies;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use DB;
use Auth;

class VisitorPpeController extends Controller
{
    public function index()
    {
        return view('admin.visitor-person.index');
    }

    public function getData($id)
    {
        $sia = VisitorPpe::select('visitor_ppe.*', 'ppe.code', 'ppe_type.goods')
            ->leftJoin('ppe', 'visitor_ppe.ppe_id', '=', 'ppe.id')
            ->leftJoin('ppe_type', 'ppe.type_id', '=', 'ppe_type.id')
            ->where('visitor_id', $id)
            ->get();

        return DataTables::of($sia)
            ->addColumn('action', function ($row) {
                return '
                    <a class="btn btn-sm btn-primary edit" href="/visitor/ppe/edit/' . $row->id . '">Edit</a>
                    <a class="btn btn-sm btn-danger delete" data-id="'.$row->id.'" href="javascript:void(0);"><i class="bx bxs-trash"></i></a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create($id = null)
    {
        return view('admin.visitor.form-ppe', compact('id'));
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

            $person = VisitorPpe::updateOrCreate([
                'id' => $request->id
            ], $request->only([
                'sia_id', 'id_card', 'fullname', 'email', 'token', 'position', 'cert_expire',
                'bpjs_number', 'score_induction', 'ktp', 'ktp_checked', 'card_id', 'card_checked',
                'passport', 'pp_checked', 'bpjs', 'bpjs_checked', 'contract', 'ct_checked',
                'cert_competence', 'cc_checked', 'medical_checkup', 'mc_checked', 'license_driver',
                'ld_checked', 'license_vaccinated', 'lv_checked', 'user_id', 'status', 'post'
            ]));

            DB::commit();
            return redirect()->route('visitor-ppe.detail', @$request->sia_id)->with(['success' => 'Data has been saved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('visitor-ppe.detail', @$request->sia_id)->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('visitor-ppe.detail', @$request->sia_id)->with(['error' => @$e->getMessage()]);
        }
    }

    public function edit($id = null)
    {
        $data = VisitorPerson::find($id);
        return view('admin.visitor.form-ppe', compact('data'));
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $sia = VisitorPerson::find($id);

            $sia->delete();

            DB::commit();
            return redirect()->route('visitor-ppe.detail', $sia->sia_id)->with(['success' => 'Data delete successfully']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('visitor-ppe.detail', $sia->sia_id)->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('visitor-ppe.detail', $sia->sia_id)->with(['error' => @$e->getMessage()]);
        }

    }
}
