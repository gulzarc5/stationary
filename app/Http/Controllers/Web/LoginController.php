<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function userLogin(Request $request, Guard $guard)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        
        $credentials = array(
            'email' => $request->input('email'),
            'password'  => $request->input('password'),
            'status'    => true,
        );
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
           
            if ($user->hasRole('user')) {
                return redirect()->intended('/user/dashboard');
            } else {
                $guard->logout();
                $request->session()->invalidate();
                return redirect()->back()->with('error','User Id And Password Wrong');
            }
        } else {          
            return redirect()->back()->with('error','User Id And Password Wrong');
        }
    }

    public function logout(Request $request, Guard $guard)
    {
        $guard->logout();
        $request->session()->invalidate();
        return redirect()->route('web.index');
    }
}
