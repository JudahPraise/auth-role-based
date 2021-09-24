<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\ResetPassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{

    public function index()
    {
        return view('auth.passwords.reset');
    }

    public function checkPassCode(Request $request)
    { 

        $check = ResetPassword::where('email','=',$request->email)->first();

        if(!empty($check)){
            $email = $request->email;
            return view('auth.passwords.reset')->with('email', $email);
        }

        session()->flash('error', 'Invalid Code!');
        return redirect()->back();
    }

    public function resetPassword(Request $request)
    {
        $user = User::where('email','=',$request->email)->first();

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('login');
    }

}
