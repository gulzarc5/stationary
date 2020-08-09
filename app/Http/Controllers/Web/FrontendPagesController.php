<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendPagesController extends Controller
{
    public function cartPage()
    {
        return view('web.cart.cart');
    }
}
