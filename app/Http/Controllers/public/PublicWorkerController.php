<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\Sia_person;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;
use Auth;

class PublicWorkerController extends Controller
{
    public function index($id = null)
    {
        return view('public.new-worker.worker');
    }

    public function getData(Request $request)
    {
        $query = Visitor::select('visitor.*', 'pic.name as pic_name')
            ->leftJoin('pic', 'visitor.pic_id', '=', 'pic.id')
            ->orderBy('created_at', 'desc');


        if ($request->has('status') && $request->status !== 'all') {
            $query->where('visitor.status', $request->status);
        }
        $visitor = $query->get();

        $visitor->transform(function ($row) {
            $row->foreign = ($row->foreign == 1) ? 'Indonesia':'Foreign';
            return $row;
        });

        $visitor->transform(function ($row) {
            if ($row->citizenship_doc) {
                $row->citizenship_doc = '/storage/'.$row->citizenship_doc;
            } else {
                $row->citizenship_doc = '';
            }
            return $row;
        });

        $visitor->transform(function ($row) {
            $btn = '';

            $person = DB::table('visitor_person')
                ->where('foreign', 2)
                ->where('visitor_id', $row->id)
                ->exists();

            if ($row->approve_1 == 1 && $row->approve_2 == 1 && $row->approve_4 == 1) {
                $btn .= "Approved";
            } else {
                if (auth()->user()->hasRole('pic') || auth()->user()->hasRole('administrator')) {
                    if ($row->approve_1 == 0) {
                        $btn .= '<a href="/visitor/approve/pic/' . $row->id . '" class="btn btn-sm btn-success mb-1 mr-1">PIC</a> ';
                    } else if( $row->approve_1 == 2) {
                        $btn .= '<a href="javascript:;" class="btn btn-sm btn-warning mb-1">Rejected by PIC</a> ';
                    } else {
                        $btn .= 'Waiting Approval By Security';
                    }
                } else if (auth()->user()->hasRole('security') || auth()->user()->hasRole('administrator')) {
                    if ($row->approve_2 == 0 && $row->approve_1 == 1 && $row->approve_3 == 0) {
                        $btn .= '<a href="/visitor/approve/security/' . $row->id . '" class="btn btn-sm btn-success mb-1">Security</a> ';
                    } else if( $row->approve_2 == 2) {
                        $btn .= '<a href="javascript:;" class="btn btn-sm btn-warning mb-1">Rejected by Security</a> ';
                    } else {
                        $btn .= 'Waiting Approval By Legal';
                    }
                } else if ( ($row->foreign == 2 or $person >= 1 ) && (auth()->user()->hasRole('legal') || auth()->user()->hasRole('administrator'))) {
                    if ($row->approve_3 == 0 && $row->approve_2 == 1 && $row->approve_1 == 1) {
                        $btn .= '<a href="/visitor/approve/legal/' . $row->id . '" class="btn btn-sm btn-success mb-1">Legal</a> ';
                    } else if( $row->approve_2 == 2) {
                        $btn .= '<a href="javascript:;" class="btn btn-sm btn-warning mb-1">Rejected by Legal</a> ';
                    } else {
                        $btn .= 'Waiting Approval By Safety';
                    }
                } elseif (auth()->user()->hasRole('safety') || auth()->user()->hasRole('administrator')) {
                    if ($row->approve_3 == 0 && $row->approve_2 == 1 && $row->approve_1 == 1) {
                        $btn .= '<a href="/visitor/approve/safety/' . $row->id . '" class="btn btn-sm btn-success">Safety</a>';
                    } else if( $row->approve_2 == 2) {
                        $btn .= '<a href="javascript:;" class="btn btn-sm btn-warning mb-1">Rejected by Safety</a> ';
                    } else {
                        $btn .= 'Approved';
                    }
                }
            }

            $row->approval = $btn;

            return $row;
        });


        $visitor->transform(function ($row) {
            $row->date_request = date('d M, Y', strtotime($row->date_request));
            return $row;
        });

        return DataTables::of($visitor)
            ->addColumn('action', function ($row) {
                return '
                    <a class="btn btn-sm btn-primary edit" href="/visitor/edit/' . $row->id . '"><i class="bx bx-pencil"></i></a>
                    <a class="btn btn-sm btn-success edit" href="/visitor/person/' . $row->id . '"><i class="bx bx-user-pin"></i></a>
                    <a class="btn btn-sm btn-danger delete" data-id="'.$row->id.'" href="javascript:void(0);"><i class="bx bxs-trash"></i></a>
                ';
            })
            ->rawColumns(['action', 'pic', 'approval', 'duration'])
            ->make(true);
    }

    // public function getData($id = null)
    // {
    //     $sia = Sia_person::select('sia_person.*')
    //         ->where('sia_id', $id)
    //         ->get();

    //     return DataTables::of($sia)
    //         ->addColumn('action', function ($row) {
    //             return '
    //                 <a class="btn btn-sm btn-primary edit" href="/u/contracts/workers/edit/' . $row->id . '">
    //                     <i class="ki-outline ki-pencil fs-5 ms-1"></i>
    //                 </a>
    //                 <a class="btn btn-sm btn-success edit disabled" href="/u/contracts/workers/detail/' . $row->id . '">
    //                     <i class="ki-outline ki-paper-clip fs-5 ms-1"></i>
    //                 </a>
    //                 <a class="btn btn-sm btn-danger delete" data-id="'.$row->id.'" href="javascript:void(0);">
    //                     <i class="ki-outline ki-trash fs-5 ms-1"></i>
    //                 </a>
    //             ';
    //         })
    //         ->rawColumns(['action'])
    //         ->make(true);
    // }

    public function create($id = null)
    {
        return view('public.new-worker.form', compact('id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_card' => 'nullable|string',
            'fullname' => 'required|string',
            'email' => 'required|string',
            'status' => 'boolean',
        ],[
            'fullname.required' => 'Fullname is required',
            'email.required' => 'Email is required',
        ]);

        DB::beginTransaction();
        try {

            $request['cert_expire'] = $request->cert_expire ? date('Y-m-d H:i:s', strtotime($request->cert_expire)) : null;

            $data = Sia_person::select('sia_id')->find($request->id);
            $person = Sia_person::updateOrCreate([
                'id' => $request->id
            ], $request->only([
                'sia_id', 'id_card', 'fullname', 'email', 'token', 'position', 'cert_expire',
                'bpjs_number', 'score_induction', 'ktp', 'ktp_checked', 'card_id', 'card_checked',
                'passport', 'pp_checked', 'bpjs', 'bpjs_checked', 'contract', 'ct_checked',
                'cert_competence', 'cc_checked', 'medical_checkup', 'mc_checked', 'license_driver',
                'ld_checked', 'license_vaccinated', 'lv_checked', 'user_id', 'status', 'post'
            ]));

            DB::commit();
            return redirect()->route('public.new-worker.index', @$request->sia_id)->with(['success' => 'Data has been saved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('public.new-worker.index', @$request->sia_id)->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('public.new-worker.index', @$request->sia_id)->with(['error' => @$e->getMessage()]);
        }
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads', $filename, 'public');

            return response()->json(['filename' => $filename, 'message' => 'File uploaded successfully'], 200);
        }

        return response()->json(['message' => 'File upload failed'], 400);
    }

    public function edit($id = null)
    {
        $data = Sia_person::where([
            'id' => $id
        ])->first();
        return view('public.new-worker.form', compact('data'));
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $sia = Sia_person::find($id);

            $sia->delete();

            DB::commit();
            return redirect()->route('public.new-worker.index', $sia->sia_id)->with(['success' => 'Data delete successfully']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('public.new-worker.index', $sia->sia_id)->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('public.new-worker.index', $sia->sia_id)->with(['error' => @$e->getMessage()]);
        }

    }

}
