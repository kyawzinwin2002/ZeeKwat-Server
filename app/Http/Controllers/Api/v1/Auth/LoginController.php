<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if(!Auth::attempt($request->only(['email', 'password']))){
            return $this->failResponse('Credential are wrong!',401);
        }

        return $this->successResponse('Login successfully', 200, [
            'user' => Auth::user(),
            'token' => Auth::user()->createToken(Auth::id())->plainText()
        ]);
    }
}
