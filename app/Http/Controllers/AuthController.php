<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{
    //Register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'username' => 'required|unique:users,username',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message'  => 'User successfully register',
            'user'     => $user,
        ], 201);
    }


    //Login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
              Auth::user();
              
            return response()->json([
             'message' => 'Login Succesfully',
            ], 200);
        }

        return response()->json([
         'message' => 'Invalid username or password',
        ], 401);
    }
}
