<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('auth.login');
    }

    public function authenticate(){
        if (!Auth::check()) {
            return view('auth.login');
        }
        
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'remember' => ['nullable']
        ]);

        $remember = $request->filled('remember');

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active' => 1], $remember)) {
            // Authentication was successful...
            $request->session()->regenerate();
 
            return redirect()->intended('/admin');  

        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'active' => 0])) {
            // Authentication wasn't successful...
            Auth::logout();
            return back()->withErrors([
                'email' => trans('auth.active'),
            ]);

        }

        return back()->withErrors([
            'email' => trans('auth.failed'),
        ]);

    }

    public function logout(){
        Auth::logout();

        return redirect('/');
    }

}
