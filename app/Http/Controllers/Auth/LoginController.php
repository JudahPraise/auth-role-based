<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function login(Request $request){

        //* Validate the form data
        $this->validate($request, [
            'password' => 'required|min:6'
        ]); 
        
        //* Attempt to log the user in
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => $request->role])) {
           switch ($request->role) {
               case 'Teacher':
                    return redirect()->intended(route('home'));
                    break;
                
                case 'Nurse':
                    return redirect()->intended(route('nurse'));
                    break;
                
                case "Admin":
                    return redirect()->intended(route('admin'));
                    break;
                
                default: 
                    return dd("You're not allowed to enter!");
           }
        }

        //* If unsuccessful, redirect back to login
        session()->flash('login', 'Invalid Credentials');
        return redirect()->back();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
