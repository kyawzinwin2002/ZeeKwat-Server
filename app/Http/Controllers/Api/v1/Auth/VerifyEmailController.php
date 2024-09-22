<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\VerifyEmailRequest;
use App\Models\User;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    public function verify(VerifyEmailRequest $request)
    {
        $email = User::where('email', $request->email)->get();

        if(!$email){
            return $this->failResponse('Something went wrong!', 500);
        }

        //Send Code to reset password

        return $this->successResponse('Verified email successfully', 200);
    }
}
