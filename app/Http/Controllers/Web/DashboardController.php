<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardView()
    {
        return view('web.profile.profile');
    }

    public function changePasswordForm()
    {
        return view('user.change_password');
    }

    public function changePassword(Request $request)
    {
        # code...
    }
}
