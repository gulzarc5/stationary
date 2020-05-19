<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use DataTables;

class UsersController extends Controller
{
    public function customerList()
    {
        return view('admin.users.customer_list');
    }

    public function retailerList()
    {
        return view('admin.users.retailer_list');
    }
}
