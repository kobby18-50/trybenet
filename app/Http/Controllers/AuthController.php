<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;




class AuthController extends Controller
{
    public function login(LoginRequest $request){

    try{

        $credentials = $request->only('email', 'password');

        if(!Auth::attempt($credentials)){
            return response()->json([
                'status' => '442',
                'message' => 'Credientials are incorrect',
                'data' => null
            ]);

        }

        $user = Auth::user();

        $token = $request->user()->createToken('auth_token');
        return response()->json([
            'status' => 200,
            'message' => 'Login Successful',
            'data' => [
                'user' => $user,
                'token' => $token
            ]
        ]);


    }catch(\Exception $e){
        return response()->json([
            'status' => 500,
            'message' => "An error occured during login",
            'error' => $e->getMessage(),
        ]);
        }

    }
}
