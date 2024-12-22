<?php

namespace App\Services;

use App\Models\TokenShare;
use Illuminate\Support\Str;

class TokenService
{
    public static function generateUniqueToken($length = 32)
    {
        do {
            // Generate random token
            $token = Str::random($length);

            // Check if token exists in the database
            $tokenExists = Token::where('token', $token)->exists();
        } while ($tokenExists);

        // Save the token to the database
        Token::create(['token' => $token]);

        return $token;
    }
}
