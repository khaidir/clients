<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use App\Models\Companies;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;
use Auth;

class VisitorController extends Controller
{
    public function index()
    {
        return view('admin.visitor.index');
    }

    public function getData()
    {
        $visitor = Visitor::select('visitor.*', 'users.name as fullname')
            ->leftJoin('users', 'visitor.user_id', '=', 'users.id')
            ->orderby('created_at', 'asc')
            ->get();

        $visitor->transform(function ($row) {
            $row->date_request = date('d M, Y', strtotime($row->date_request));
            return $row;
        });

        return DataTables::of($visitor)
            ->addColumn('action', function ($row) {
                return '
                    <a class="btn btn-sm btn-primary edit" href="/visitor/edit/' . $row->id . '">Edit</a>
                    <a class="btn btn-sm btn-success edit" href="/visitor/detail/' . $row->id . '">Detail</a>
                    <a class="btn btn-sm btn-danger delete" data-id="'.$row->id.'" href="javascript:void(0);"><i class="bx bxs-trash"></i></a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function detail($id = null)
    {
        $data = Visitor::select('*')
            ->find($id);

        return view('admin.visitor.detail', compact('data', 'id'));
    }

    public function create()
    {
        $company = Companies::all();
        return view('admin.visitor.form', compact('company'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:160',
            'destination' => 'required|string|max:40',
            'duration' => 'nullable|string|max:3',
            'status' => 'nullable|boolean',
        ],[
            'description.required' => 'Description is required',
            'destination.required' => 'Destination is required',
        ]);

        DB::beginTransaction();
        try {

            if (empty($request->user_id)) {
                $request['user_id'] = Auth::id();
            }

            $request['date_request'] = date('Y-m-d H:i:s', strtotime($request->date_request));

            $visitor = Visitor::updateOrCreate(
                ['id' => $request->id ?? null],
                $request->only([
                    'user_id',
                    'description',
                    'destination',
                    'duration',
                    'date_request',
                    'status'
                ])
            );

            DB::commit();
            return redirect()->route('visitor.index')->with(['success' => 'Data has been saved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('visitor.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('visitor.index')->with(['error' => @$e->getMessage()]);
        }
    }

    public function edit($id = null)
    {
        $data = Visitor::find($id);
        return view('admin.visitor.form', compact('data'));
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $sia = Visitor::find($id);

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
            return redirect()->route('sia.index')->with(['error' => @$e->getMessage()]);
        }

    }
}
