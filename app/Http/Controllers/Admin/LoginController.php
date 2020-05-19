<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function adminLogin(Request $request, Guard $guard)
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
           
            if ($user->hasRole('admin')) {
                return redirect()->intended('/admin/dashboard');
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
        return redirect()->route('admin.login_form');
    }
}
