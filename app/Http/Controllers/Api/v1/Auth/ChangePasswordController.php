<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function change(ChangePasswordRequest $request)
    {
        $user = User::where('id', Auth::id())->get();

        if(!Hash::check($request->password, $user->password)){
            return $this->failResponse('Wrong password!', 401);
        }

        $user->password = $request->password;
        $user->update();

        return $this->successResponse('Changed password successfully',200);
    }
}
