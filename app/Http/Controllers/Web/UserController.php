<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;
use Auth;

class UserController extends Controller
{
    public function shippingAdd(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required',
            'mobile' => 'required',
            'state' => 'required',
            'city' => 'required',
            'pin' => 'required',
        ]);

        $address = new Address();
        $address->name = $request->input('name');
        $address->user_id = Auth::user()->id;
        $address->email = $request->input('email');
        $address->mobile = $request->input('mobile');
        $address->address = $request->input('address');
        $address->state = $request->input('state');
        $address->city = $request->input('city');
        $address->pin = $request->input('pin');

        $address->save();
        return redirect()->back();
    }
}
