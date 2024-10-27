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

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|integer',
            'email' => 'required|integer',
            'status' => 'boolean',
        ],[
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
        ]);

        DB::beginTransaction();
        try {

            $dokumen = Users::find(Auth::id())->update([
                'id' => @$request->id
            ], @$request->all());

            DB::commit();
            return redirect()->route('profile')->with(['success' => 'Profile has been saved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('profile')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('profile')->with(['error' => @$e->getMessage()]);
        }
    }

}
