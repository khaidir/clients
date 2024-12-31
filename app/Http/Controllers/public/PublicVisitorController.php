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
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\TextPart;
use Carbon\Carbon;
use DB;
use Auth;

class PublicVisitorController extends Controller
{
    public function landing()
    {
        DB::beginTransaction();
        try {

            $code = $this->generateUniqueCode(24);
            $token = Token::create([
                'token' => $code,  // Misalkan 'code' adalah kolom yang ingin diisi
                'description' => 'auto', // Status yang ingin diset
                'status' => 1,     // Misalkan ini adalah ID pengguna yang sesuai
            ]);

            DB::commit();
            return redirect('/invite/'. $code)->with(['success' => 'Data has been saved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect('/invite/'. $code)->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect('/invite/'. $code)->with(['error' => @$e->getMessage()]);
        }
    }

    public function index($token = null)
    {
        // cek token, ready standby at this page else redirect with sorry word
        $token = Token::where('token', $token)->first();
        if (!$token) {
            return redirect('/vp')->with(['danger' => 'Page not found, please submit your data.']);
        }

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

        if (!$token) {
            return redirect('/vp')->with(['danger' => 'Page not found, please submit your data.']);
        }


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

    // public function direct_token($token = null)
    // {
    //     $token = $this->base64_decrypt($token, 7);
    //     $token = Token::where('token', $token)->first();
    //     return redirect('/invite/'. $token->token)->with(['success' => 'Selamat, silahkan masukkan data anda dengan lengkap.']);
    // }

    public function store(Request $request)
    {

        $request->validate([
            'fullname' => 'required|string',
            'ocuppational' => 'nullable|string',
            'email' => 'required|string',
            'citizenship_number' => 'nullable|string',
            'description' => 'nullable|string',
            'destination' => 'nullable|string',
            'duration' => 'nullable|string',
        ], [
            'fullname.required' => 'Full name is required',
            'email.required' => 'Email is required',
            'citizenship_number.required' => 'Card ID is required',
        ]);

        DB::beginTransaction();
        try {

            $dateRequest = now();
            $token = $request->token;
            $token = Token::where('token', $token)->first();

            $ss_1 = ($request->ppe_shoes_size_1 == null) ? '' : $request->ppe_shoes_size_1;
            $ss_2 = ($request->ppe_shoes_size_2 == null) ? '' : $request->ppe_shoes_size_2;
            $ss_3 = ($request->ppe_shoes_size_3 == null) ? '' : $request->ppe_shoes_size_3;
            $ss_4 = ($request->ppe_shoes_size_4 == null) ? '' : $request->ppe_shoes_size_4;
            $ss_5 = ($request->ppe_shoes_size_5 == null) ? '' : $request->ppe_shoes_size_5;
            $ss_6 = ($request->ppe_shoes_size_6 == null) ? '' : $request->ppe_shoes_size_6;
            $ss_7 = ($request->ppe_shoes_size_7 == null) ? '' : $request->ppe_shoes_size_7;
            $ss_8 = ($request->ppe_shoes_size_8 == null) ? '' : $request->ppe_shoes_size_8;
            $ss_9 = ($request->ppe_shoes_size_9 == null) ? '' : $request->ppe_shoes_size_9;

            $vs_1 = ($request->ppe_vest_size_1 == null) ? '' : $request->ppe_vest_size_1;
            $vs_2 = ($request->ppe_vest_size_2 == null) ? '' : $request->ppe_vest_size_2;
            $vs_3 = ($request->ppe_vest_size_3 == null) ? '' : $request->ppe_vest_size_3;
            $vs_4 = ($request->ppe_vest_size_4 == null) ? '' : $request->ppe_vest_size_4;
            $vs_5 = ($request->ppe_vest_size_5 == null) ? '' : $request->ppe_vest_size_5;
            $vs_6 = ($request->ppe_vest_size_6 == null) ? '' : $request->ppe_vest_size_6;
            $vs_7 = ($request->ppe_vest_size_7 == null) ? '' : $request->ppe_vest_size_7;

            $ppe_shoes_size = $ss_1 .';'. $ss_2 .';'. $ss_3 .';'. $ss_4 .';'. $ss_5 .';'. $ss_6 .';'. $ss_7 .';'. $ss_8 .';'. $ss_9;
            $ppe_vest_size = $vs_1 .';'. $vs_2 .';'. $vs_3 .';'. $vs_4 .';'. $vs_5 .';'. $vs_6 . ';'.$vs_7;

            $visitor = Visitor::updateOrCreate(
                ['token_id' => $token->id],
                [
                    'request_code' => $this->generateUniqueCode(8),
                    'fullname' => $request->fullname,
                    'ocuppational' => $request->ocuppational,
                    'email' => $request->email,
                    'citizenship_number' => $request->citizenship_number,
                    'foreign' => $request->citizenship,
                    'citizenship_doc' => $request->ktp,
                    'description' => @$request->description,
                    'destination' => $request->destination,

                    'ppe' => ($request->ppe == null) ? false : true,
                    'ppe_helmet' => $request->ppe_helmet,
                    'ppe_glasses' => $request->ppe_glasses,
                    'ppe_shoes_size' => $ppe_shoes_size,
                    'ppe_vest_size' => $ppe_vest_size,

                    'pic_id' => $request->pic,
                    'duration' => $request->duration,
                    'date_request' => $dateRequest,
                ]
            );

            $personilData = [];
            if (!empty($request->name) && !empty($request->citi_id)) {
                foreach ($request->name as $index => $name) {
                    if (empty($name) || empty($request->citi_id[$index])) {
                        continue;
                    }

                    $personilId = $request->vid[$index] ?? null;

                    $personil = [
                        'visitor_id' => $visitor->id,
                        'name' => $name,
                        'ocuppational' => $request->work[$index],
                        'foreign' => $request->foreign[$index],
                        'citizenship' => $request->citi_id[$index],
                        'notes' => null,
                        'status' => true,
                    ];

                    if ($request->hasFile("attachment.$index")) {
                        $personil['citizenship_docs'] = $request->file("attachment.$index")->store('attachments', 'public');
                    } else {
                        $personil['citizenship_docs'] = null;
                    }

                    if ($personilId) {
                        $existingPersonil = VisitorPerson::find($personilId);

                        if ($existingPersonil) {
                            $existingPersonil->update([
                                'name' => $personil['name'],
                                'ocuppational' => $personil['ocuppational'],
                                'foreign' => $personil['foreign'],
                                'citizenship' => $personil['citizenship'],
                                'citizenship_docs' => $personil['citizenship_docs'],
                                'notes' => $personil['notes'],
                                'status' => $personil['status'],
                            ]);
                        }
                    } else {
                        $personilData[] = $personil; // Data baru hanya ditambahkan di sini
                    }
                }

                if (count($personilData) > 0) {
                    VisitorPerson::upsert(
                        collect($personilData)->map(fn ($personil) => Arr::except($personil, ['unique_key']))->toArray(),
                        ['id'],
                        ['foreign', 'name', 'ocuppational', 'citizenship', 'citizenship_docs', 'notes', 'status']
                    );
                }
            }


            // // Generate PDF
            // $pdf = Pdf::loadView('public.invite.invitation', [
            //     'visitor' => $visitor,
            //     'personil' => $personilData ?? [],
            // ]);

            // $filePath = 'invitations/invitation_' . $visitor->id . '.pdf';
            // Storage::disk('public')->put($filePath, $pdf->output());

            // if (Storage::disk('public')->exists($filePath)) {
            //     $pic = Pic::select('pic.id', 'pic.name', 'pic.email')
            //         ->where('pic.id', $request->pic)
            //         ->first();

            //     $data = [
            //         'subject' => 'Invitation Details',
            //         'content' => 'Please find the invitation attached.',
            //     ];

            //     Mail::to($pic->email)->send(new SendEmail($data, $filePath));
            // }

            // $this->sendmailuser($request->fullname, $request->email);


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

    function generateUniqueCode($length = 8) {
        $timestamp = microtime(true);
        $timestampHex = dechex($timestamp);
        $randomString = bin2hex(random_bytes($length / 2));
        $uniqueCode = strtoupper($timestampHex . $randomString);
        return substr($uniqueCode, 0, $length);
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

}
