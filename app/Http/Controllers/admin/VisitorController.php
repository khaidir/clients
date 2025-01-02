<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use App\Models\Companies;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;
use Auth;

class VisitorController extends Controller
{
    public function index()
    {
        return view('admin.visitor.index');
    }

    public function getData(Request $request)
    {
        $query = Visitor::select('visitor.*', 'users.name as fullname', 'pic.name as pic_name')
            ->leftJoin('users', 'visitor.user_id', '=', 'users.id')
            ->leftJoin('pic', 'visitor.pic_id', '=', 'pic.id')
            ->orderBy('created_at', 'desc');

        if ($request->has('status') && $request->status !== 'all') {
            $query->where('visitor.status', $request->status);
        }

        $visitor = $query->get();

        $visitor->transform(function ($row) {
            $hour = ($row->duration > 1) ? ' Hours' : ' Hour';
            $row->duration = $row->duration .$hour;
            return $row;
        });

        $visitor->transform(function ($row) {
            $row->pic = $row->pic_name;
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
                        $btn .= '<a href="javascript:;" class="btn btn-sm btn-warning mb-1">Rejected</a> ';
                    } else {
                        $btn .= 'Approved';
                    }
                }
                if (auth()->user()->hasRole('security') || auth()->user()->hasRole('administrator')) {
                    if ($row->approve_2 == 0 && $row->approve_1 == 1 && $row->approve_3 == 0) {
                        $btn .= '<a href="/visitor/approve/security/' . $row->id . '" class="btn btn-sm btn-success mb-1">Security</a> ';
                    } else {
                        $btn .= 'Approved';
                    }
                }
                if ( ($row->foreign == 2 or $person >= 1 ) && (auth()->user()->hasRole('legal') || auth()->user()->hasRole('administrator'))) {
                    if ($row->approve_3 == 0 && $row->approve_2 == 1 && $row->approve_1 == 1) {
                        $btn .= '<a href="/visitor/approve/legal/' . $row->id . '" class="btn btn-sm btn-success mb-1">Legal</a> ';
                    } else {
                        $btn .= 'Approved';
                    }
                }
                if (auth()->user()->hasRole('safety') || auth()->user()->hasRole('administrator')) {
                    if ($row->approve_3 == 0 && $row->approve_2 == 1 && $row->approve_1 == 1) {
                        $btn .= '<a href="/visitor/approve/safety/' . $row->id . '" class="btn btn-sm btn-success">Safety</a>';
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

    public function person($id = null)
    {
        $data = Visitor::select('*')
            ->find($id);

        return view('admin.visitor.person', compact('data', 'id'));
    }

    public function ppe($id = null)
    {
        $data = Visitor::select('*')
            ->find($id);

        $size_shoes = explode(';', $data->ppe_shoes_size);
        $size_vest = explode(';', $data->ppe_vest_size);

        return view('admin.visitor.ppe', compact('data', 'id', 'size_shoes', 'size_vest'));
    }

    public function create()
    {
        $company = Companies::all();
        return view('admin.visitor.form', compact('company'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'destination' => 'required|string|max:40',
            'duration' => 'nullable|string|max:3',
            'status' => 'nullable|boolean',
        ],[
            'description.required' => 'Description is required',
            'destination.required' => 'Destination is required',
        ]);

        DB::beginTransaction();
        try {

            if (empty($request->user_id)) {
                $request['user_id'] = Auth::id();
            }

            $request['date_request'] = date('Y-m-d H:i:s', strtotime($request->date_request));

            $visitor = Visitor::updateOrCreate(
                ['id' => $request->id ?? null],
                $request->only([
                    'user_id',
                    'description',
                    'destination',
                    'duration',
                    'date_request',
                    'status'
                ])
            );

            DB::commit();
            return redirect()->route('visitor.index')->with(['success' => 'Data has been saved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('visitor.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('visitor.index')->with(['error' => @$e->getMessage()]);
        }
    }

    public function edit($id = null)
    {
        $data = Visitor::find($id);
        return view('admin.visitor.form', compact('data'));
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $visitor = Visitor::find($id);

            $visitor->delete();

            DB::commit();
            return redirect()->route('visitor.index')->with(['success' => 'Data delete successfully']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('visitor.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('visitor.index')->with(['error' => @$e->getMessage()]);
        }

    }

    public function massDelete(Request $request)
    {
        $ids = $request->ids;

        if (!is_array($ids) || empty($ids)) {
            return response()->json(['message' => 'No IDs provided.'], 400);
        }

        // Hapus data berdasarkan IDs
        Visitor::whereIn('id', $ids)->delete();

        return response()->json(['message' => 'Selected rows deleted successfully.']);
    }

    public function massApprove(Request $request)
    {
        $ids = $request->ids;
        $status = $request->status;

        if (!is_array($ids) || empty($ids)) {
            return response()->json(['message' => 'No IDs provided.'], 400);
        }

        if (!$status) {
            return response()->json(['message' => 'No status provided.'], 400);
        }

        // Update status approval berdasarkan IDs
        if (auth()->user()->hasRole('pic')) {
            Visitor::whereIn('id', $ids)->update(['approve_1' => $status]);
        }
        if (auth()->user()->hasRole('security')) {
            Visitor::whereIn('id', $ids)->update(['approve_2' => $status]);
        }
        if (auth()->user()->hasRole('safety')) {
            Visitor::whereIn('id', $ids)->update(['approve_3' => $status]);
        }

        return response()->json(['message' => 'Selected rows updated successfully.']);
    }

    public function pic($id = null)
    {
        DB::beginTransaction();
        try {

            $visitor = Visitor::find($id);

            if (!$visitor) {
                return redirect()->route('visitor.index')->with(['success' => 'Visitor not found']);
            }

            $visitor->update([
                'approve_1' => 1,
            ]);

            if ($visitor->approve_1 == 1 && $visitor->approve_2 == 1 && $visitor->approve_3 == 1) {
                $visitor->update([
                    'status' => 1,
                ]);
            }

            DB::commit();
            return redirect()->route('visitor.index')->with(['success' => 'Data has been approved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('visitor.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('visitor.index')->with(['error' => @$e->getMessage()]);
        }
    }

    public function security($id = null)
    {
        DB::beginTransaction();
        try {

            $visitor = Visitor::find($id);

            if (!$visitor) {
                return redirect()->route('visitor.index')->with(['success' => 'Visitor not found']);
            }

            $visitor->update([
                'approve_2' => 1,
            ]);

            if ($visitor->approve_1 == 1 && $visitor->approve_2 == 1 && $visitor->approve_3 == 1) {
                $visitor->update([
                    'status' => 1,
                ]);
            }

            DB::commit();
            return redirect()->route('visitor.index')->with(['success' => 'Data has been approved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('visitor.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('visitor.index')->with(['error' => @$e->getMessage()]);
        }
    }

    public function legal($id = null)
    {
        DB::beginTransaction();
        try {

            $visitor = Visitor::find($id);

            if (!$visitor) {
                return redirect()->route('visitor.index')->with(['success' => 'Visitor not found']);
            }

            $visitor->update([
                'approve_3' => 1,
            ]);

            if ($visitor->approve_1 == 1 && $visitor->approve_2 == 1) {
                $visitor->update([
                    'status' => 1,
                ]);
            }

            DB::commit();
            return redirect()->route('visitor.index')->with(['success' => 'Data has been approved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('visitor.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('visitor.index')->with(['error' => @$e->getMessage()]);
        }
    }

    public function safety($id = null)
    {
        DB::beginTransaction();
        try {

            $visitor = Visitor::find($id);

            if (!$visitor) {
                return redirect()->route('visitor.index')->with(['success' => 'Visitor not found']);
            }

            $visitor->update([
                'approve_4' => 1,
            ]);

            if ($visitor->approve_1 == 1 && $visitor->approve_2 == 1) {
                $visitor->update([
                    'status' => 1,
                ]);
            }

            DB::commit();
            return redirect()->route('visitor.index')->with(['success' => 'Data has been approved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('visitor.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('visitor.index')->with(['error' => @$e->getMessage()]);
        }
    }

    function generateUniqueCode($length = 8) {
        // Ambil timestamp saat ini
        $timestamp = microtime(true);

        // Konversi timestamp ke format unik (heksadesimal)
        $timestampHex = dechex($timestamp);

        // Buat string acak
        $randomString = bin2hex(random_bytes($length / 2));

        // Gabungkan timestamp dan string acak
        $uniqueCode = strtoupper($timestampHex . $randomString);

        return substr($uniqueCode, 0, $length);
    }
}
