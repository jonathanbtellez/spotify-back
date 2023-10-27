<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\AuthLoginRequest;
use App\Http\Requests\Auth\AuthRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request)
    {
        $attempt = Auth::attempt($request->only('email','password'), $request->remember_me);
        
        if(!$attempt) return response()->json(['errors'=>['credentials'=>'Email or password not valid']],404);
        
        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('token')->plainTextToken;

        $data = ['token' => $token, 'user' => $user];
        return response()->json($data,201);
    }

    public function Register(AuthRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'birth_date' => $request->birth_day,

        ]);

        $token = $user->createToken('token')->plainTextToken;
        Auth::login($user);
        $data = ['token' => $token, 'user' => $user];
        return response()->json($data,201);
    }
}