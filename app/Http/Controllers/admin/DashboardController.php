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

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function getData()
    {
        $sia = Sias::select('sia.id', 'sia.description', 'sia.dete_request', 'sia.status', 'users.name as fullname', 'companies.name as company')
            ->leftJoin('users', 'sia.user_id', '=', 'users.id')
            ->leftJoin('companies', 'sia.company_id', '=', 'companies.id')
            ->get();

        $sia->transform(function ($row) {
            $row->date_request = Carbon::parse($row->date_request)->format('d M, Y H:i');
            return $row;
        });

        return DataTables::of($sia)
            ->addColumn('action', function ($row) {
                return '
                    <a class="btn btn-sm btn-primary edit" href="/worker/edit/' . $row->id . '"><i class="bx bx-pencil"></i></a>
                    <a class="btn btn-sm btn-success edit" href="/worker/detail/' . $row->id . '">Detail</a>
                    <a class="btn btn-sm btn-danger delete" data-id="'.$row->id.'" href="javascript:void(0);"><i class="bx bxs-trash"></i></a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

}
