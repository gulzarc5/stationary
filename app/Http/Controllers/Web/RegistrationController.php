<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;
class RegistrationController extends Controller
{
    public function  registerUser(Request $request){
        $this->validate($request, [
            'full_name' => 'required',
            'email' =>      'required|email',
            'phone' =>      'required|min:10',
            'password'  => 'required|confirmed|min:6',
        ]);

        $full_name = $request->input('full_name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $password = $request->input('password');
        
        $role = Role::where('id', 2)->first();

        $mobile_check = User::where('mobile', $request->input('phone'))->count();
        if($mobile_check){
            return back()->with('error', 'Mobile No already exists!!!');
        }

        $email_check = User::where('email', $request->input('email'))->count();
        if($email_check){
            return back()->with('error', 'Email Already exists!!!');
        }

        $user = new User;
        $user->name = $full_name;
        $user->email = $email;
        $user->mobile = $phone;
        $user->password = bcrypt($password);
        if($user->save()){
            $roleuser = User::find($user->id);
            $roleuser->roles()->attach($role);
            return redirect()->route('web.login')->with('message', 'Registerd Successfully!');
        }
    }
}
