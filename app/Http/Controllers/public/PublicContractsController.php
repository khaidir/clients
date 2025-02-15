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
        $sia = Sias::select('sia.id', 'sia.description', 'sia.dete_request', 'sia.status',
                'sia_extended.description_of_task', 'sia_extended.no_contract', 'sia_extended.periode_start', 'sia_extended.periode_start',
                'users.name as fullname', 'companies.name as company')
            ->leftJoin('users', 'sia.user_id', '=', 'users.id')
            ->leftJoin('companies', 'sia.company_id', '=', 'companies.id')
            ->leftJoin(
                DB::raw('(SELECT * FROM sia_extended WHERE id IN (SELECT MAX(id) FROM sia_extended GROUP BY sia_id)) as sia_extended'),
                'sia.id', '=', 'sia_extended.sia_id'
            )
            ->where('sia.company_id', Auth::user()->company_id)
            ->get();

        $sia->transform(function ($row) {
            $row->periode = Carbon::parse($row->periode_start)->format('d M, Y') .' - '. Carbon::parse($row->periode_end)->format('d M, Y');
            $row->date_request = Carbon::parse($row->date_request)->format('d M, Y H:i');
            return $row;
        });

        return DataTables::of($sia)
            ->addColumn('action', function ($row) {
                return '
                    <a class="btn btn-sm btn-primary edit" href="/u/contract/edit/' . $row->id . '"><i class="bx bx-pencil"></i></a>
                    <a class="btn btn-sm btn-warning edit" href="/u/contract/detail/' . $row->id . '"><i class="bx bx-detail"></i></a>
                    <a class="btn btn-sm btn-danger delete" data-id="'.$row->id.'" href="javascript:void(0);"><i class="bx bxs-trash"></i></a>
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
            'company_id' => 'required|integer',
            'description_of_task' => 'required|string',
            'periode_start' => 'required|string',
            'periode_end' => 'required|string',
        ],[
            // 'description_of_task.required' => 'Company is required',
        ]);

        DB::beginTransaction();
        try {

            if ( @$request->id == '' ) {
                $request['user_id'] = Auth::id();
            }

            $request['periode_start'] = date('Y-m-d', strtotime($request->periode_start));
            $request['periode_end'] = date('Y-m-d', strtotime($request->periode_end));

            $worker = Sias::updateOrCreate([
                'id' => @$request->id
            ], @$request->all());

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
