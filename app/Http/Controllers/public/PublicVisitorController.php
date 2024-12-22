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

        DB::beginTransaction();
        try {

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
                        'status' => 'false',
                    ];

                    // Handle file uploads (only if the file exists)
                    if ($request->hasFile("attachment.$index")) {
                        // Store the uploaded file if it exists, otherwise leave it as null
                        $personil['docs_citizenship'] = $request->file("attachment.$index")->store('attachments', 'public');
                    } else {
                        // If no file is uploaded, set docs_citizenship as null
                        $personil['docs_citizenship'] = null;
                    }

                    // Check if the personil already exists
                    $existingPersonil = VisitorPerson::where('visitor_id', $visitor->id)
                                                      ->where('name', $name)
                                                      ->first();

                    if ($existingPersonil) {
                        // Update the existing personil data
                        $existingPersonil->update([
                            'citizenship' => $personil['citizenship'],
                            'docs_citizenship' => $personil['docs_citizenship'], // Allow null if no file is uploaded
                            'notes' => $personil['notes'],
                            'status' => $personil['status'],
                        ]);
                    } else {
                        // If personil doesn't exist, add new data
                        $personilData[] = $personil;
                    }
                }

                // Insert or update personil data if there is new data to insert
                if (count($personilData) > 0) {
                    VisitorPerson::upsert(
                        collect($personilData)->map(fn ($personil) => Arr::except($personil, ['unique_key']))->toArray(),
                        ['id'], // Use 'id' for conflict detection
                        ['citizenship', 'docs_citizenship', 'notes', 'status'] // Update only these fields
                    );
                }
            }

            DB::commit();
            return redirect('invite/draft/'. $token->token)->with(['success' => 'Data has been saved']);
        } catch (ValidationException $e) {
            DB::rollback();
            return redirect('invite/draft/'. $token->token)->with(['warning' => $e->errors()]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('invite/draft/'. $token->token)->with(['error' => $e->getMessage()]);
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
            // $file->storeAs('public/uploads', $filename);
            $file->storeAs('uploads', $filename, 'public');

            return response()->json(['filename' => $filename, 'message' => 'File uploaded successfully'], 200);
        }

        return response()->json(['message' => 'File upload failed'], 400);
    }

}
