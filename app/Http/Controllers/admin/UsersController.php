<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Companies;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Hash;
use DB;
use Auth;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function getData()
    {
        $user = User::select('*')
            ->orderBy('id','asc')
            ->get();

        $user->transform(function ($user) {
            $roles = $user->getRoleNames();

            $rolesString = implode(', ', $roles->toArray());
            $rolesString = ucwords($rolesString);

            $badgeHtml = '';
            foreach ($roles as $role) {
                if ($role == 'company') {
                    $company = Companies::where('id', $user->company_id)->first();
                    $badgeHtml .= "<span class='badge bg-primary'>".ucwords($role) .': '. $company->name."</span> ";
                } else {
                    $badgeHtml .= "<span class='badge bg-primary'>". ucwords($role) ."</span> ";
                }
            }
            $user->roles_names = $badgeHtml;

            return $user;
        });

        return DataTables::of($user)
            ->addColumn('action', function ($row) {
                return '
                    <a class="btn btn-sm btn-primary edit" href="/users/edit/' . $row->id . '"><i class="bx bx-pencil"></i></a>
                    <a class="btn btn-sm btn-danger delete" data-id="'.$row->id.'" href="javascript:void(0);"><i class="bx bxs-trash"></i></a>
                ';
            })
            ->rawColumns(['action', 'roles_names'])
            ->make(true);
    }

    public function create()
    {
        $roles = Role::select('id', 'name')->get();
        $company = Companies::select('id', 'name')->get();
        return view('admin.users.form', compact('roles', 'company'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'status' => 'boolean',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ],[
            'name.required' => 'Fullname is required',
            'email.required' => 'Email is required',
            'roles.*.exists' => 'Some selected roles do not exist',
        ]);

        DB::beginTransaction();
        try {

            $input = $request->all();

            if (isset($input['password']) && !empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                unset($input['password']);
            }

            $user = User::updateOrCreate([
                'id' => $input['id']
            ], $input);

            if (isset($input['roles'])) {
                $validRoles = Role::whereIn('id', $input['roles'])->pluck('id')->toArray();
                $user->syncRoles($validRoles);
            }

            DB::commit();
            return redirect()->route('users.index')->with(['success' => 'Data has been saved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('users.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('users.index')->with(['error' => @$e->getMessage()]);
        }
    }

    public function edit($id = null)
    {

        $user = User::findOrFail($id);
        $roles = Role::select('id', 'name')->get();
        $userRole = $user->roles->pluck('id', 'name')->toArray();
        $company = Companies::select('id', 'name')->get();

        return view('admin.users.form', compact('user','roles', 'userRole', 'company'));
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $user = User::find($id);
            $user->delete();

            DB::commit();
            return redirect()->route('users.index')->with(['success' => 'Data delete successfully']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('users.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('users.index')->with(['danger' => @$e->getMessage()]);
        }

    }
}
