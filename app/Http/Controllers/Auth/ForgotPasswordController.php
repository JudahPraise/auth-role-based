<?php

namespace App\Http\Controllers\Auth;

use App\ResetPassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    public function addCode(Request $request)
    {
        $code = new ResetPassword();

        $code->email = $request->email;
        $code->code = $request->code;

        $code->save();\

        session()->flash('success', 'Code set successfully!');
        return redirect()->back();
    }

}
