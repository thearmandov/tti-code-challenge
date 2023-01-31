<?php

namespace App\Http\Controllers;

use Auth;
use App\Helpers\FormatUtility;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construcT()
    {
        $this->format = new FormatUtility();
    }
    //
    public function login(Request $request) {
        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            $data = [
                'error' => 'Unauthorized. Invalid Credentials.'
            ];

            return response()->json($this->format->formatJsonResponse('auth', $data), 401);
        }

        $user = $request->user();

        if ($user->is_doctor) {
            $token = $request->user()->createToken('user-access',['get-patients']);
            $data = [
                'email' => $user->email,
                'access_token' => $token->plainTextToken
            ];

            return response()->json($this->format->formatJsonResponse('auth', $data), 200);
        }

        $token = $request->user()->createToken('user-access', []);
        $data = [
            'email' => $user->email,
            'access_token' => $token->plainTextToken
        ];

        return response()->json($this->format->formatJsonResponse('auth', $data), 200);
        
    }
}
