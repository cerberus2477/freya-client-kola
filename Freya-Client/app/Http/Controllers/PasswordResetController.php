<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PasswordResetController extends Controller
{
    public function showResetForm(Request $request)
    {
        // Extract token and email from the query parameters
        $token = $request->query('token');
        $email = $request->query('email');

        // Pass the token and email to the view
        return view('password-reset', compact('token', 'email'));
    }
    
    public function resetPassword(Request $request)
    {

        // Prepare the API request data
        $data = [
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
            'token' => $request->token,
        ];

        // Send the reset password request to the API
        $response = Http::freyarest()->withHeaders([
            'Accept' => 'application/json',
            'Accept-Encoding' => 'gzip, deflate, br',
            'Connection' => 'keep-alive',
            'Content-Type' => 'application/json',
            'User-Agent' => 'EchoapiRuntime/1.1.0',
        ])->post('reset-password', $data);

        // Handle the API response
        if ($response->successful()) {
            return back()->with('status', 'A jelszó sikeresen megváltoztatva!');
        } else {
            $errorMessage = $response->json()['message'] ?? 'A jelszó megváltoztatása sikertelen. Kérjük, próbálja újra.';
            return back()->withErrors(['error' => $errorMessage]);
        }
    }
}
