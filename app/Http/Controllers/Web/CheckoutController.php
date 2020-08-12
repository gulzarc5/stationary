<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Cart;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderDetalis;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $user_id = Auth::user()->id;
        $address = Address::where('user_id',$user_id)->get();
        $cart_total = 0;
        $cart = Auth::user()->cart();

        if ($cart->count() > 0) {
            $cart = $cart->get();
            foreach ($cart as $key => $carts) {
            
                $cart_total+= ($carts->sizes->customer_price*$carts->quantity);
            }                
        }
        return view('web.checkout.checkout',compact('address','cart_total'));
    }

    public function OrderPlace(Request $request)
    {
        $this->validate($request, [
            'address_id'   => 'required',
            'payment_method' => 'required',
        ]);

        $address_id = $request->input('address_id');
        $payment_method = $request->input('payment_method');
        $user_id = Auth::user()->id;
        $cart = Auth::user()->cart();
        if ($cart->count() > 0) {
            $cart = $cart->get();
            $order = new Order();
            $order->user_id = $user_id;
            $order->payment_status=$payment_method;
            $order->save();

            $total_quantity = 0;
            $total_price = 0;
            if ($order->save()) {
                foreach ($cart as $key => $carts) {
                    $total_quantity+= $carts->quantity;
                    $total_price+= ($carts->quantity * $carts->sizes->customer_price);

                    $order_details = new OrderDetalis();
                    $order_details->user_id = $user_id;
                    $order_details->order_id = $order->id;
                    $order_details->product_id = $carts->product_id;
                    $order_details->size_id = $carts->size_id;
                    $order_details->total_quantity = $carts->quantity;
                    $order_details->price = $carts->sizes->customer_price;
                    $order_details->total_discount = 0;
                    $order_details->total_amount = ($carts->quantity * $carts->sizes->customer_price);
                    $order_details->save();
                }
                $order_update = Order::find($order->id);
                $order_update->total_quantity = $total_quantity;
                $order_update->total_price = $total_price;
                $order_update->save();
                
                return view('web.checkout.confirm-order');
            }else{
                return redirect()->back();
            }
                          
        }else{
            return redirect()->back();
        }
        return view('web.checkout.checkout',compact('address','cart_total'));
    }
}
