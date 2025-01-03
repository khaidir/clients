<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;
use Auth;

class PublicProfileController extends Controller
{
    public function index()
    {
        $data = User::find(Auth::id());
        return view('public.profile.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
        ],[
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
        ]);

        DB::beginTransaction();
        try {

            $user = User::find(auth()->user()->id);

            if ($request->filled('password')) {
                $request->validate([
                    'password' => 'required|min:8|confirmed',
                ]);

                $user->password = Hash::make($request->password);
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->position = $request->position;
            $user->address = $request->address;
            $user->save();

            DB::commit();
            return redirect()->route('public.profile')->with(['success' => 'Profile has been saved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('public.profile')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('public.profile')->with(['error' => @$e->getMessage()]);
        }
    }

}
