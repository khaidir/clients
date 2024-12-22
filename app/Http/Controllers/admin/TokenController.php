<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Token;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use DB;
use Auth;

class TokenController extends Controller
{
    public function index()
    {
        return view('admin.token.index');
    }

    public function getData()
    {
        $token = Token::select('token_share.*')
            ->orderBy('created_at','desc')
            ->get();

        $token->transform(function ($row) {
            $row->status = $row->status == 1 ? 'Active' : 'Inactive';
            return $row;
        });

        $token->transform(function ($row) {
            $copyText = url('/direct/i/' . $this->base64_encrypt($row->token, 7));
            $row->share = '
                <a href="#"
                data-copy="' . $copyText . '"
                class="btn btn-sm btn-success btn-copy">
                <i class="bx bx-share-alt"></i> Copy
                </a>';
            return $row;
        });

        return DataTables::of($token)
            ->addColumn('action', function ($row) {
                return '
                    <a class="btn btn-sm btn-primary edit" href="/token/edit/' . $row->id . '"><i class="bx bx-pencil"></i></a>
                    <a class="btn btn-sm btn-danger delete" data-id="'.$row->id.'" href="javascript:void(0);"><i class="bx bxs-trash"></i></a>
                ';
            })
            ->rawColumns(['action', 'share'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.token.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string',
            'status' => 'nullable|boolean',
        ],[
            'description.required' => 'Description is required',
        ]);

        DB::beginTransaction();
        try {

            $request['token'] = $this->generateUniqueCode(24);
            $data = $request->only(['id', 'token', 'description']);

            $token = Token::updateOrCreate(
                ['id' => $data['id'] ?? null],
                $data
            );

            DB::commit();
            return redirect()->route('token.index')->with(['success' => 'Data has been saved']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('token.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('token.index')->with(['error' => @$e->getMessage()]);
        }
    }

    public function edit($id = null)
    {
        $data = Token::find($id);
        return view('admin.token.form', compact('data'));
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {
            $sia = Token::find($id);
            $sia->delete();

            DB::commit();
            return redirect()->route('token.index')->with(['success' => 'Data delete successfully']);
        } catch (ValidationException $e)
        {
            DB::rollback();
            return redirect()->route('token.index')->with(['warning' => @$e->errors()]);
        } catch (\Exception $e)
        {
            DB::rollback();
            return redirect()->route('token.index')->with(['danger' => @$e->getMessage()]);
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
