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

    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required|string',
            'email' => 'required|string',
        ], [
            'fullname.required' => 'Full name is required',
            'email.required' => 'Email is required',
        ]);

        DB::beginTransaction();
        try {
            $dateRequest = now();
            $token = Token::where('token', $request->token)->first();

            $ppe_shoes_size = implode(';', array_filter([
                $request->ppe_shoes_size_1 ?? '',
                $request->ppe_shoes_size_2 ?? '',
                $request->ppe_shoes_size_3 ?? '',
                $request->ppe_shoes_size_4 ?? '',
                $request->ppe_shoes_size_5 ?? '',
                $request->ppe_shoes_size_6 ?? '',
                $request->ppe_shoes_size_7 ?? '',
                $request->ppe_shoes_size_8 ?? '',
                $request->ppe_shoes_size_9 ?? '',
            ]));

            $ppe_vest_size = implode(';', array_filter([
                $request->ppe_vest_size_1 ?? '',
                $request->ppe_vest_size_2 ?? '',
                $request->ppe_vest_size_3 ?? '',
                $request->ppe_vest_size_4 ?? '',
                $request->ppe_vest_size_5 ?? '',
                $request->ppe_vest_size_6 ?? '',
                $request->ppe_vest_size_7 ?? '',
            ]));

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
                    'description' => $request->description,
                    'destination' => $request->destination,
                    'ppe' => $request->ppe ?? false,
                    'ppe_helmet' => $request->ppe_helmet,
                    'ppe_glasses' => $request->ppe_glasses,
                    'ppe_shoes_size' => $ppe_shoes_size,
                    'ppe_vest_size' => $ppe_vest_size,
                    'pic_id' => $request->pic,
                    'duration' => $request->duration,
                    'date_request' => $dateRequest,
                ]
            );

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('invite/draft/' . $request->token)->with(['error' => $e->getMessage()]);
        }

        // Handle looping data setelah commit transaksi utama
        try {
            $personilData = [];
            foreach ($request->name as $index => $name) {
                if (empty($name) || empty($request->citi_id[$index])) {
                    continue;
                }

                $personilId = $request->vid[$index] ?? null;

                $personil = [
                    'visitor_id' => $visitor->id,
                    'name' => $name,
                    'ocuppational' => $request->work[$index] ?? null,
                    'foreign' => $request->foreign[$index] ?? null,
                    'citizenship' => $request->citi_id[$index],
                    'notes' => null,
                    'status' => true,
                    'citizenship_docs' => null, // Set default null
                ];

                if ($request->hasFile("attachment.$index")) {
                    $personil['citizenship_docs'] = $request->file("attachment.$index")->store('attachments', 'public');
                }

                if ($personilId) {
                    $existingPersonil = VisitorPerson::find($personilId);

                    if ($existingPersonil) {
                        $updateData = [
                            'name' => $personil['name'],
                            'ocuppational' => $personil['ocuppational'],
                            'foreign' => $personil['foreign'],
                            'citizenship' => $personil['citizenship'],
                            'notes' => $personil['notes'],
                            'status' => $personil['status'],
                        ];

                        // Tambahkan 'citizenship_docs' hanya jika ada file baru
                        if (isset($personil['citizenship_docs'])) {
                            $updateData['citizenship_docs'] = $personil['citizenship_docs'];
                        }

                        $existingPersonil->update($updateData);
                    }
                } else {
                    $personilData[] = $personil;
                }
            }

            if (count($personilData) > 0) {
                VisitorPerson::upsert(
                    collect($personilData)
                        ->map(function ($personil) {
                            return array_merge([
                                'citizenship_docs' => null,
                            ], $personil);
                        })
                        ->toArray(),
                    ['id'],
                    ['foreign', 'name', 'ocuppational', 'citizenship', 'citizenship_docs', 'notes', 'status']
                );
            }

            // Simpan data PDF dan kirim email
            $pdf = Pdf::loadView('public.invite.invitation', [
                'visitor' => $visitor,
                'personil' => [],
            ]);
            $filePath = 'invitations/invitation_' . $visitor->id . '.pdf';
            Storage::disk('public')->put($filePath, $pdf->output());

            if (Storage::disk('public')->exists($filePath)) {
                $pic = Pic::find($request->pic);
                if ($pic) {
                    Mail::to($pic->email)->send(new SendEmail([
                        'subject' => 'Visitor Notification',
                        'content' => "Hi, ".$pic->name."<br><br>Anda memiliki visitor baru yang harus anda tindak lanjuti.<br>
                        Klik <a href='".url('/setuju/'.@$visitor->id)."'>Approve</a> jika anda setuju dan <a href='".url('/reject/'.@$visitor->id)."'>Reject</a> jika tidak setuju.<br>
                        <br>Terima Kasih.",
                    ], $filePath));
                }
            }

            sendmailuser($request->fullname, $request->email);

        } catch (\Exception $e) {
            return redirect('invite/draft/' . $request->token)->with(['warning' => 'Some personnel data failed to save.']);
        }

        return redirect('invite/draft/' . $request->token)->with(['success' => 'Data has been saved']);
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

    public function setuju($id = null)
    {
        DB::beginTransaction();
        try {

            $visitor = Visitor::find($id);

            $visitor->update([
                'approve_1' => 1,
            ]);

            if ($visitor->approve_1 == 1 && $visitor->approve_2 == 1 && $visitor->approve_3 == 1) {
                $visitor->update([
                    'status' => 1,
                ]);
            }

            DB::commit();
            return 'Data has been approved<br><a href="/">Kembali</a>';
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect('/setuju/'. $id)->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect('/setuju/'. $id)->with(['error' => @$e->getMessage()]);
        }
    }

    public function reject($id = null)
    {
        return view('public.invite.reject', compact('id'));
    }

    public function rejected(Request $request)
    {
        DB::beginTransaction();
        try {

            $visitor = Visitor::where('id', $request->id)->first();

            if ($visitor) {
                $visitor->update([
                    'approve_1' => 2,
                    'description' => $request->reason,
                ]);
            } else {
                return response()->json(['error' => 'Visitor not found'], 404);
            }

            if ($visitor->approve_1 == 1 && $visitor->approve_2 == 1 && $visitor->approve_3 == 1) {
                $visitor->update([
                    'status' => 1,
                ]);
            }

            DB::commit();
            return 'Data has been rejected<br><a href="/">Kembali</a>';
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect('/reject/'. $request->id)->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect('/reject/'. $request->id)->with(['error' => @$e->getMessage()]);
        }
    }


}
