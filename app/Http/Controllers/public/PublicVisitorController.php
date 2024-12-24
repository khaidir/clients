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
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use DB;
use Auth;

class PublicVisitorController extends Controller
{
    public function index($token = null)
    {
        // cek token, ready standby at this page else redirect with sorry word
        $token = Token::where('token', $token)->first();

        $pic = Pic::select('pic.*', 'users.name as fullname')
            ->leftJoin('users', 'pic.user_id', '=', 'users.id')
            ->orderBy('created_at','desc')
            ->get();

        $data = Visitor::select('visitor.*')
            ->leftJoin('pic', 'pic.id', '=', 'visitor.pic_id')
            ->leftJoin('users', 'pic.user_id', '=', 'users.id')
            ->where('token_id', $token->id)->first();

        return view('public.invite.index', compact('data', 'pic', 'token'));
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
            ->where('token_id', $token->id)
            ->first();

        $size_shoes = !empty(@$data->ppe_shoes_size) ? explode(';', @$data->ppe_shoes_size) : [];
        $size_vest = !empty(@$data->ppe_vest_size) ? explode(';', @$data->ppe_vest_size) : [];

        $personils = VisitorPerson::where('visitor_id', $data->id)->get();

        return view('public.invite.draft', compact('data', 'personils', 'pic', 'token', 'size_shoes', 'size_vest'));
    }

    public function direct_token($token = null)
    {
        $token = $this->base64_decrypt($token, 7);
        $token = Token::where('token', $token)->first();
        return redirect('/invite/'. $token->token)->with(['success' => 'Selamat, silahkan masukkan data anda dengan lengkap.']);
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

            $ppe_shoes_size = $request->ppe_shoes_size_1 .';'. $request->ppe_shoes_size_2 .';'. $request->ppe_shoes_size_3;
            $ppe_vest_size = $request->ppe_vest_size_1 .';'. $request->ppe_vest_size_2 .';'. $request->ppe_vest_size_3;

            $visitor = Visitor::updateOrCreate(
                ['token_id' => $token->id],
                [
                    'request_code' => $this->generateUniqueCode(8),
                    'fullname' => $request->fullname,
                    'email' => $request->email,
                    'citizenship_id' => $request->citizenship_id,
                    'citizenship_doc' => $request->ktp,
                    'description' => $request->description,
                    'destination' => $request->destination,

                    'ppe' => $request->ppe,
                    'ppe_helmet' => $request->ppe_helmet,
                    'ppe_glasses' => $request->ppe_glasses,
                    'ppe_shoes' => $request->ppe_shoes,
                    'ppe_shoes_size' => $ppe_shoes_size,
                    'ppe_vest' => $request->ppe_shoes,
                    'ppe_vest_size' => $ppe_vest_size,

                    'pic_id' => $request->pic,
                    'duration' => $request->duration,
                    'date_request' => $dateRequest,
                ]
            );

            if (!empty($request->name) && !empty($request->citi_id)) {
                $personilData = [];
                foreach ($request->name as $index => $name) {
                    // Pastikan bahwa nama dan citi_id tidak kosong
                    if (empty($name) || empty($request->citi_id[$index])) {
                        continue; // Skip iterasi ini jika salah satu kosong
                    }

                    // Mengambil ID berdasarkan input 'vid[]'
                    $personilId = $request->vid[$index] ?? null; // Jika tidak ada, set null

                    $personil = [
                        'visitor_id' => $visitor->id,
                        'name' => $name,
                        'foreign' => $request->foreign[$index],
                        'citizenship' => $request->citi_id[$index],
                        'notes' => null,
                        'status' => '1',
                    ];

                    // Handle file uploads (only if the file exists)
                    if ($request->hasFile("attachment.$index")) {
                        // Store the uploaded file if it exists, otherwise leave it as null
                        $personil['docs_citizenship'] = $request->file("attachment.$index")->store('attachments', 'public');
                    } else {
                        // If no file is uploaded, set docs_citizenship as null
                        $personil['docs_citizenship'] = null;
                    }

                    // Check if the personil already exists (based on 'vid[]' value)
                    if ($personilId) {
                        $existingPersonil = VisitorPerson::find($personilId); // Find person by ID

                        if ($existingPersonil) {
                            // Update the existing personil data
                            $existingPersonil->update([
                                'name' => $personil['name'],
                                'foreign' => $personil['foreign'],
                                'citizenship' => $personil['citizenship'],
                                'docs_citizenship' => $personil['docs_citizenship'], // Allow null if no file is uploaded
                                'notes' => $personil['notes'],
                                'status' => $personil['status'],
                            ]);
                        }
                    } else {
                        // If personil doesn't exist (i.e., no 'vid[]' value), add new data
                        $personilData[] = $personil;
                    }
                }

                // Insert or update personil data if there is new data to insert
                if (count($personilData) > 0) {
                    VisitorPerson::upsert(
                        collect($personilData)->map(fn ($personil) => Arr::except($personil, ['unique_key']))->toArray(),
                        ['id'], // Use 'id' for conflict detection
                        ['foreign','citizenship', 'docs_citizenship', 'notes', 'status'] // Update only these fields
                    );
                }
            }

            $this->sendmailuser($request->fullname, $request->email);

            // get data pic
            $pic = Pic::select('pic.id', 'pic.name', 'pic.email')
                ->where('pic.id', $request->pic)
                ->first();
            if ($pic) {
                $this->sendmailpic($pic->name, $pic->email);
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

    public function sendmailuser($name = null, $email = null)
    {
        $data = [
            'subject' => 'Invitation Notification',
            'content' => "Hi, ".$name."<br><br>Selamat anda telah berhasil mengisi data invitation dengan benar dan dibutuhkan approval dari PIC, Security, dan Safety.<br><br>Terima Kasih.",
        ];

        Mail::to($email)->send(new SendEmail($data));

        return response()->json(['message' => 'Email sent successfully!']);
    }

    public function sendmailpic($name = null, $email = null)
    {
        $data = [
            'subject' => 'Visitor Notification',
            'content' => "Hi, ".$name."<br><br>Anda memiliki visitor baru yang harus anda tindak lanjuti.<br><br>Terima Kasih.",
        ];

        Mail::to($email)->send(new SendEmail($data));

        return response()->json(['message' => 'Email sent successfully!']);
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

    public function destroy($id)
    {
        $person = VisitorPerson::select('visitor_person.visitor_id')
                ->where('visitor_person.id', $id)
                ->first();
        $visitor = Visitor::select('token_id')->find($person->visitor_id);
        $token = Token::select('token')->find($visitor->token_id);

        DB::beginTransaction();
        try {
            $visitor = VisitorPerson::find($id);
            $visitor->delete();

            DB::commit();
            return redirect('invite/draft/'. $token->token)->with(['success' => 'Data delete successfully']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect('invite/draft/'. $token->token)->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect('invite/draft/'. $token->token)->with(['danger' => @$e->getMessage()]);
        }

    }

    function base64_encrypt(string $text, int $times = 1): string
    {
        $encoded = $text;
        for ($i = 0; $i < $times; $i++) {
            $encoded = base64_encode($encoded);
        }
        return $encoded;
    }

    function base64_decrypt(string $encodedText, int $times = 1): string
    {
        $decoded = $encodedText;
        for ($i = 0; $i < $times; $i++) {
            $decoded = base64_decode($decoded, true);
            if ($decoded === false) {
                throw new Exception("Invalid Base64 string");
            }
        }
        return $decoded;
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
