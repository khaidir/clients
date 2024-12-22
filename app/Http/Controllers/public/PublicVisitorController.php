<?php

namespace App\Http\Controllers\public;

use App\Http\Controllers\Controller;
use App\Models\Pic;
use App\Models\Token;
use App\Models\Visitor;
use App\Models\VisitorPerson;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use DB;
use Auth;

class PublicVisitorController extends Controller
{
    public function index($token = null)
    {
        // cek token, ready standby at this page else redirect with sorry word

        $pic = Pic::select('pic.*', 'users.name as fullname')
            ->leftJoin('users', 'pic.user_id', '=', 'users.id')
            ->orderBy('created_at','desc')
            ->get();

        return view('public.invite.index', compact('pic', 'token'));
    }

    public function draft($token = null)
    {
        $token = Token::where('token', $token)->first();

        $pic = Pic::select('pic.*', 'users.name as fullname')
            ->leftJoin('users', 'pic.user_id', '=', 'users.id')
            ->orderBy('created_at','desc')
            ->get();

        $data = Visitor::select('visitor.*')
            ->leftJoin('pic', 'pic.id', '=', 'visitor.pic_id')
            ->leftJoin('users', 'pic.user_id', '=', 'users.id')
            ->where('token_id', $token->id)->first();

        $personils = VisitorPerson::where('visitor_id', $data->id)->get();

        return view('public.invite.draft', compact('data', 'personils', 'pic', 'token'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'fullname' => 'required|string',
            'email' => 'required|string',
            'citizenship_id' => 'nullable|string',
            'description' => 'required|string',
            'destination' => 'required|string',
            'duration' => 'nullable|string',
        ], [
            'fullname.required' => 'Full name is required',
            'email.required' => 'Email is required',
            'citizenship_id.required' => 'Card ID is required',
        ]);

        // DB::beginTransaction();
        // try {

            $dateRequest = now();
            $token = $request->token;
            $token = Token::where('token', $token)->first();

            $visitor = Visitor::updateOrCreate(
                ['token_id' => $token->id],
                [
                    'fullname' => $request->fullname,
                    'email' => $request->email,
                    'citizenship_id' => $request->citizenship_id,
                    'citizenship_doc' => $request->citizenship_doc,
                    'description' => $request->description,
                    'destination' => $request->destination,
                    'duration' => $request->duration,
                    'date_request' => $dateRequest,
                ]
            );

            if (!empty($request->name)) {
                $personilData = [];
                foreach ($request->name as $index => $name) {
                    $personil = [
                        'visitor_id' => $visitor->id,
                        'name' => $name,
                        'citizenship' => $request->citi_id[$index] ?? null,
                        'notes' => null,
                        'status' => false,
                    ];

                    // Handle file uploads
                    if ($request->hasFile("attachment.$index")) {
                        $personil['docs_citizenship'] = $request->file("attachment.$index")->store('attachments', 'public');
                    }

                    // Add condition for upsert (matching `name` and `visitor_id`)
                    $personil['unique_key'] = "{$visitor->id}_{$name}"; // Temporary unique identifier
                    $personilData[] = $personil;
                }

                // Insert or update personil data
                VisitorPerson::upsert(
                    collect($personilData)->map(fn ($personil) => Arr::except($personil, ['unique_key']))->toArray(),
                    ['visitor_id', 'name'], // Fields to match for update
                    ['citizenship', 'docs_citizenship', 'notes', 'status'] // Fields to update
                );
            }

        //     DB::commit();
        //     return redirect('invite/draft/'. $token)->with(['success' => 'Data has been saved']);
        // } catch (ValidationException $e) {
        //     DB::rollback();
        //     return redirect('invite/'. $token)->with(['warning' => $e->errors()]);
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return redirect('invite/'. $token)->with(['error' => $e->getMessage()]);
        // }
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            // $file->storeAs('public/uploads', $filename);
            $file->storeAs('uploads', $filename, 'public');

            return response()->json(['filename' => $filename, 'message' => 'File uploaded successfully'], 200);
        }

        return response()->json(['message' => 'File upload failed'], 400);
    }

}
