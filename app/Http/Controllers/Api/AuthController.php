<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
//use auth
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //index register
    public function register(Request $request)
    {
        $input = [
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' => $request->email,
        ];
        $user = User::create($input);
        return response()->json([
            'status'=> 'success',
            'message'=> 'Register Success',
        ]);
    }

    //login
    public function login(Request $request)
    {
        $input = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $user = User::where('email', $input['email'])->first();
        $token = $user->createToken('token')->plainTextToken;
        if(Auth::attempt($input)){
            return response()->json([
                'code' => 200,
                'status' => 'success',
                'message' => 'Login Success',
                'token' => $token
            ]);
        }else{
            return response()->json([
                'code' => 401,
                'status' => 'error',
                'message' => 'Login Failed'
                ]);
        }

    }
}
