<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function orderList()
    {
        return view('admin.orders.new_order_list');
    }

    public function orderListAjax(Request $request)
    {
        $query = Order::orderBy('id','desc'); 
        return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn ='<a href="#" class="btn btn-info btn-sm" target="_blank">View</a>';
                
                
                return $btn;
            })->addColumn('name', function($row){
                if (isset($row->user_id)) {
                    return $row->user->name;
                } else {
                    return null;
                }
            })
            ->rawColumns(['action','name'])
            ->make(true);
    }
}
