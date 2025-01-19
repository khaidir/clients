<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Sias;
use App\Models\Companies;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;
use Auth;

class SiaController extends Controller
{

    public function __construct()
    {
        // $this->middleware('permission:sia-list', ['only' => ['index', 'store']]);
    }

    public function index()
    {
        return view('admin.new-worker.index');
    }

    public function getData()
    {
        $sia = Sias::select('sia.id', 'sia.description', 'sia.dete_request',
                'sia.status', 'users.name as fullname', 'companies.name as company',
                'sia_extended.description_of_task', 'sia_extended.no_contract',
                'sia_extended.periode_start', 'sia_extended.periode_start')
            ->leftJoin('users', 'sia.user_id', '=', 'users.id')
            ->leftJoin('companies', 'sia.company_id', '=', 'companies.id')
            ->leftJoin(
                DB::raw('(SELECT * FROM sia_extended WHERE id IN (SELECT MAX(id) FROM sia_extended GROUP BY sia_id)) as sia_extended'),
                'sia.id',
                '=',
                'sia_extended.sia_id'
            )
            ->get();

        $sia->transform(function ($row) {
            $row->periode = Carbon::parse($row->periode_start)->format('d M, Y') .' - '. Carbon::parse($row->periode_end)->format('d M, Y');
            $row->date_request = Carbon::parse($row->date_request)->format('d M, Y H:i');
            return $row;
        });

        return DataTables::of($sia)
            ->addColumn('action', function ($row) {
                return '
                    <a class="btn btn-sm btn-primary edit" href="/worker/edit/' . $row->id . '"><i class="bx bx-pencil"></i></a>
                    <a class="btn btn-sm btn-warning edit" href="/worker/detail/' . $row->id . '"><i class="bx bx-detail"></i></a>
                    <a class="btn btn-sm btn-danger delete" data-id="'.$row->id.'" href="javascript:void(0);"><i class="bx bxs-trash"></i></a>
                ';
            })
            ->rawColumns(['action', 'periode', 'date_request'])
            ->make(true);
    }

    public function detail($id = null)
    {
        $data = Sias::select('sia.id', 'sia.description', 'sia.status', 'users.name as fullname', 'companies.name as company')
            ->leftJoin('users', 'sia.user_id', '=', 'users.id')
            ->leftJoin('companies', 'sia.company_id', '=', 'companies.id')
            ->find($id);

        return view('admin.new-worker.detail', compact('data', 'id'));
    }

    public function create()
    {
        $company = Companies::all();
        return view('admin.new-worker.form', compact('company'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'nullable|integer',
            'company_id' => 'required|integer',
            'description' => 'nullable|string',
            'status' => 'nullable|boolean',
        ],[
            'company_id.required' => 'Company is required',
        ]);

        DB::beginTransaction();
        try {

            if ( @$request->id == '' ) {
                $request['user_id'] = Auth::id();
            }
            $request['dete_request'] = date('Y-m-d', strtotime($request->dete_request));

            $dokumen = Sias::updateOrCreate([
                'id' => @$request->id
            ], @$request->all());

            DB::commit();
            return redirect()->route('sia.index', $request->request_id)->with(['success' => 'Data has been saved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('sia.index', $request->request_id)->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('sia.index', $request->request_id)->with(['error' => @$e->getMessage()]);
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
