<?php

namespace App\Http\Controllers;

use App\helper\Apihelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Str;


class GoogleAuthController extends Controller
{
    public function redirect()
    {
        $query = http_build_query([
            'client_id' => env('GOOGLE_CLIENT_ID'),
            'redirect_uri' => env('GOOGLE_REDIRECT_URI'),
            'response_type' => 'code',
            'scope' => 'https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile',
            'access_type' => 'offline',
            'prompt' => 'consent',
        ]);

        return redirect('https://accounts.google.com/o/oauth2/v2/auth?' . $query);
    }

    public function callback(Request $request)
    {
        $tokenResponse = Http::asForm()->post('https://oauth2.googleapis.com/token', [
            'code' => $request->code,
            'client_id' => env('GOOGLE_CLIENT_ID'),
            'client_secret' => env('GOOGLE_CLIENT_SECRET'),
            'redirect_uri' => env('GOOGLE_REDIRECT_URI'),
            'grant_type' => 'authorization_code',
        ]);

        $accessToken = $tokenResponse['access_token'];

        $googleUser = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get('https://www.googleapis.com/oauth2/v2/userinfo')->json();

        $user = User::firstOrCreate(
            ['email' => $googleUser['email']],
            [
                'name' => $googleUser['name'],
                'password' => bcrypt(Str::random(16)),
                'phone' => '01559333247',
            ]
        );

        $token = $user->createToken('google-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function loginWithGoogle(Request $request)
    {
        $request->validate([
            'id_token' => 'required|string'
        ]);
        $response = Http::get('https://oauth2.googleapis.com/tokeninfo', [
            'id_token' => $request->id_token,
        ]);

        if ($response->failed()) {
            return response()->json(['message' => 'Invalid Google token'], 401);
        }

        $googleUser = $response->json();
        $user = User::firstOrCreate(
            ['email' => $googleUser['email']],
            [
                'name' => $googleUser['name'] ?? 'Google User',
                'password' => bcrypt(Str::random(16)),
                'phone' => '01559333247'
            ]
        );
        $token = $user->createToken('google-token')->plainTextToken;
        return
            Apihelper::sendrespone('200','LOGIN SUCCESSFULLY',[
                'token' => $token,
                'name' => $user->name,
                'email' => $user->email,
            ]);
    }
}
