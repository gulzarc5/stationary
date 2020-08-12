<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Session;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('web.login');
    }
    public function userLogin(Request $request, Guard $guard)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
      
        $credentials = array(
            'email' => $request->input('email'),
            'password'  => $request->input('password'),
            'status'    => 1,
        );
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
           
            if ($user->hasRole('user')) {
                
                if (Session::has('cart') && !empty(Session::get('cart'))) {
                    $cart = Session::get('cart');
                    $user_id = Auth::user()->id;
                    if (count($cart) > 0) {
                        foreach ($cart as $product_id => $value1) {
                            $cart_check = Cart::where('product_id',$product_id)->where('size_id',$value1['size_id'])->where('user_id',$user_id)->count();
                            if ($cart_check < 1) {
                                $cart_insert = new Cart();
                                $cart_insert->user_id = $user_id;
                                $cart_insert->product_id = $product_id;
                                $cart_insert->quantity = $value1['quantity'];
                                $cart_insert->size_id = $value1['size_id'];
                                $cart_insert->save();
                            }                            
                        }
                    }
                }

                return redirect()->intended('/user/dashboard');
            } else {
                $guard->logout();
                $request->session()->invalidate();
                return redirect()->route('web.login')->with('error','User Id And Password Wrong');
            }
        } else {          
            return redirect()->route('web.login')->with('error','User Id And Password Wrong');
        }
    }

    public function logout(Request $request, Guard $guard)
    {
        $guard->logout();
        $request->session()->invalidate();
        return redirect()->route('web.login');
    }
}
