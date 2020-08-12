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
            'email' =>      'required|email|unique:users,email',
            'phone' =>      'required|min:10|unique:users,mobile',
            'password'  => 'required|confirmed|min:6',
        ]);

        $full_name = $request->input('full_name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $password = $request->input('password');
    
        $role = Role::where('id', 2)->first();

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
