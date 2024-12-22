<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Pic;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;
use Auth;

class PicController extends Controller
{
    public function index()
    {
        return view('admin.pic.index');
    }

    public function getData()
    {
        $pic = Pic::select('pic.*')
            ->orderBy('created_at','desc')
            ->get();

        $pic->transform(function ($row) {
            $user = User::find($row->user_id)->name;
            $row->name = $row->name.'<br><span class="">'.$user.'</span>';
            return $row;
        });

        $pic->transform(function ($row) {
            $row->status = $row->status == 1 ? 'Active' : 'Inactive';
            return $row;
        });

        return DataTables::of($pic)
            ->addColumn('action', function ($row) {
                return '
                    <a class="btn btn-sm btn-primary edit" href="/pic/edit/' . $row->id . '"><i class="bx bx-pencil"></i></a>
                    <a class="btn btn-sm btn-danger delete" data-id="'.$row->id.'" href="javascript:void(0);"><i class="bx bxs-trash"></i></a>
                ';
            })
            ->rawColumns(['action', 'name'])
            ->make(true);
    }

    public function create()
    {
        $users = User::get();
        return view('admin.pic.form', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'status' => 'nullable|boolean',
        ],[
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
        ]);

        DB::beginTransaction();
        try {

            $data = $request->only(['id', 'user_id', 'name', 'segment', 'description', 'email', 'status']);

            $pic = Pic::updateOrCreate(
                ['id' => $data['id'] ?? null],
                $data
            );

            DB::commit();
            return redirect()->route('pic.index')->with(['success' => 'Data has been saved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('pic.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('pic.index')->with(['error' => @$e->getMessage()]);
        }
    }

    public function edit($id = null)
    {
        $data = Pic::find($id);
        $users = User::get();
        return view('admin.pic.form', compact('data', 'users'));
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $sia = Pic::find($id);
            $sia->delete();

            DB::commit();
            return redirect()->route('pic.index')->with(['success' => 'Data delete successfully']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('pic.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('pic.index')->with(['danger' => @$e->getMessage()]);
        }

    }

}
