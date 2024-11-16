<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\Sias;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;
use Auth;

class PublicWorkerController extends Controller
{
    public function index()
    {
        return view('public.new-worker.worker');
    }

    public function getData()
    {
        $sia = Sias::select('sia.id', 'sia.description', 'sia.dete_request', 'sia.status')
            ->where('sia.company_id', Auth::user()->company_id)
            ->get();

        $sia->transform(function ($row) {
            $row->date_request = Carbon::parse($row->date_request)->format('d M, Y H:i');
            return $row;
        });

        return DataTables::of($sia)
            ->addColumn('action', function ($row) {
                return '
                    <a href="/u/contracts/workers/edit' . $row->id . '" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary">
                        Detail
                        <i class="ki-outline ki-right fs-5 ms-1"></i>
                    </a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}
