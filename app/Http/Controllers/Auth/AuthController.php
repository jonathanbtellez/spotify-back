<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return response()->json('login view');
    }

    public function Register()
    {
        return response()->json('Register view');
    }
}