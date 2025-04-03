<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function login(Request $request){
        $credentials = [
            "email" => $request["email"],
            "password" => $request["password"]
        ];

        if (Auth::guard('web')->attempt($credentials)){
            $user = Auth::guard('web')->user();

            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->accessToken;

            return response()->json([
                'success' => true,
                'access_token' => $token,
                'user' => $user
            ]);
        }
        else {
            return response()->json([
                'success' => false,
                'error' => 'Unauthorized'
            ]);
        }
    }

    function signup(Request $request){
        $user = new User;
        $user->full_name = $request["full_name"];
        $user->email = $request["email"];
        $user->password = bcrypt($request["password"]);
        $user->save();

        return response()->json([
            "success" => true,
            "user" => $user
        ]);
    }
}
