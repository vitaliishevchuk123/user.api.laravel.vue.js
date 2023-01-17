<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Token;
use Illuminate\Support\Str;

class TokenController extends Controller
{
    public function createToken()
    {
        $token = Token::query()->create([
                'token' => Str::random(64),
                'expires_at' => now()->addMinutes(40),
            ]
        );
        return response()->json(['token' => $token->token]);
    }
}
