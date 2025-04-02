<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login(Request $request){

        $credentials=[
            "email"=> $request["email"],
            "password" => $request["password"]
        ];

        if (Auth::attempt($credentials)){

            $user = Auth::user();
            $token= $user->createToken('Personal Access Token')->accessToken;

            return response()->json([
                'success' => true,
                'access_token' => $token,
                'user' => $user
            ]);
        }

        else {
            return response()->json(['success' => false, 'error' => 'Unauthorized'], 401);
        }



    }
}
