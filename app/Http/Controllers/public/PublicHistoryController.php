<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;
use Auth;

class PublicHistoryController extends Controller
{
    public function index()
    {
        return view('public.history.index');
    }

    public function getData()
    {
        $history = History::select('history.*')
            ->orderBy('created_at','desc')
            ->get();

        return DataTables::of($history)
            ->make(true);
    }
}
