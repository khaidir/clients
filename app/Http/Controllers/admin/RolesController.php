<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;
use Auth;

class RolesController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
        // $this->middleware('permission:role-create', ['only' => ['create','store']]);
        // $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        return view('admin.roles.index');
    }

    public function getData()
    {
        $company = Role::select('*')
            ->orderBy('created_at','desc')
            ->get();

        return DataTables::of($company)
            ->addColumn('action', function ($row) {
                return '
                    <a class="btn btn-sm btn-primary edit" href="/roles/edit/' . $row->id . '"><i class="bx bx-pencil"></i></a>
                    <a class="btn btn-sm btn-danger delete" data-id="'.$row->id.'" href="javascript:void(0);"><i class="bx bxs-trash"></i></a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        // $permissions = Permission::get();
        $permissions = DB::table('permissions')
            ->leftJoin('permission_groups', 'permissions.group_id', '=', 'permission_groups.id')
            ->select('permissions.group_id', 'permissions.id', 'permissions.name', 'permission_groups.name as group_name')
            ->get()
            ->groupBy('group_name');

        return view('admin.roles.form', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'permission' => 'required',
        ],[
            'name.required' => 'Roles is required',
        ]);

        DB::beginTransaction();
        try {

            if ( @$request->id == '' ) {
                $request['user_id'] = Auth::id();
            }

            $role = Role::updateOrCreate([
                'id' => @$request->id
            ], @$request->all());

            $permissions = Permission::whereIn('id', $request->permission)->get(['name'])->toArray();

            $role->syncPermissions($permissions);

            DB::commit();
            return redirect()->route('roles.index')->with(['success' => 'Data has been saved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('roles.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('roles.index')->with(['error' => @$e->getMessage()]);
        }
    }

    public function edit($id = null)
    {
        $data = Role::find($id);
        // $permission = Permission::get();
        $permissions = DB::table('permissions')
            ->leftJoin('permission_groups', 'permissions.group_id', '=', 'permission_groups.id')
            ->select('permissions.group_id', 'permissions.id', 'permissions.name', 'permission_groups.name as group_name')
            ->get()
            ->groupBy('group_name');
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('admin.roles.form', compact('data','permissions','rolePermissions'));
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $role = Role::find($id);
            $role->delete();

            DB::commit();
            return redirect()->route('roles.index')->with(['success' => 'Data delete successfully']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('roles.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('roles.index')->with(['danger' => @$e->getMessage()]);
        }

    }
}
