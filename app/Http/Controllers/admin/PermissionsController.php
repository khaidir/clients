<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Models\PermissionGroup;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;
use Auth;

class PermissionsController extends Controller
{
    public function index()
    {
        return view('admin.permissions.index');
    }

    public function getData()
    {
        $permissions = Permission::select('permissions.*', 'permission_groups.name as group_name', 'permission_groups.slug as group_slug', 'permission_groups.description as group_description')
            ->leftJoin('permission_groups', 'permissions.group_id', '=', 'permission_groups.id')
            ->orderBy('group_name','asc')
            ->orderBy('permissions.name','asc')
            ->get();

        return DataTables::of($permissions)
            ->addColumn('action', function ($row) {
                return '
                    <a class="btn btn-sm btn-primary edit" href="/permissions/edit/' . $row->id . '"><i class="bx bx-pencil"></i></a>
                    <a class="btn btn-sm btn-danger delete" data-id="'.$row->id.'" href="javascript:void(0);"><i class="bx bxs-trash"></i></a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $group = PermissionGroup::get();
        return view('admin.permissions.form', compact('group'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'group_id' => 'required|integer',
            'name' => 'required|string',
        ],[
            'required.required' => 'Group is required',
            'name.required' => 'Permission name is required',
        ]);

        DB::beginTransaction();
        try {

            $permission = Permission::updateOrCreate([
                'id' => @$request->id
            ], @$request->all());

            DB::commit();
            return redirect()->route('permissions.index')->with(['success' => 'Data has been saved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('permissions.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('permissions.index')->with(['error' => @$e->getMessage()]);
        }
    }

    public function edit($id = null)
    {
        $group = PermissionGroup::get();
        $data = Permission::find($id);
        return view('admin.permissions.form', compact('data', 'group'));
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $pms = Permissions::find($id);
            $pms->delete();

            DB::commit();
            return redirect()->route('permissions.index')->with(['success' => 'Data delete successfully']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('permissions.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('permissions.index')->with(['danger' => @$e->getMessage()]);
        }

    }
}
