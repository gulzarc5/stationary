<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Models\ProductSize;
use App\Models\Product;
use App\Models\Cart;

class CartController extends Controller
{

    public function AddCart(Request $request)
    {
        $this->validate($request, [
            'product_id'   => 'required',
            'p_quantity' => 'required',
            'size_id' => 'required',
        ]);
       
    	$product_id = $request->input('product_id');
    	$quantity = $request->input('p_quantity');
        $size_id = $request->input('size_id');
        
        //*********************if user is logged in*********************
        if( Auth::check() && !empty(Auth::user()->id)) {
            $user_id = Auth::user()->id;

            // Check This Product Is already Exist in Cart Or Not
            $cart_check = Cart::where('product_id',$product_id)->where('size_id',$size_id )->where('user_id',$user_id)->count();
      
            if ($cart_check > 0 ) {
                return redirect()->route('web.view_cart');
            }

            $cart_insert = new Cart();
            $cart_insert->user_id = $user_id;
            $cart_insert->product_id = $product_id;
            $cart_insert->quantity = $quantity;
            $cart_insert->size_id = $size_id;
            $cart_insert->save();

            return redirect()->route('web.view_cart');
        }else{
            //***************If Guest User***************
            if (Session::has('cart') && !empty(Session::get('cart'))) {
                $cart = Session::get('cart');
                $cart[$product_id] =[
                     'quantity' => $quantity,
                     'size_id'=>$size_id,
                 ];
            }else{
                $cart = [
                    $product_id => [
                     'quantity' => $quantity,
                     'size_id'=>$size_id,
                    ],
                ];
            }
            Session::put('cart', $cart);
            Session::save();
            return redirect()->route('web.view_cart');
        }
        // dd(session()->all());
       // Session::forget('cart.'.$product_id);

        // dd(Session::get('cart'));
    }

    public function viewCart()
    {
        $cartData =[];
        if( Auth::check() && !empty(Auth::user()->id)) {
            
            $user_id = Auth::user()->id;
            $cart = Cart::where('user_id',$user_id);
            if ($cart->count() > 0) {
                $cart = $cart->get();
                foreach ($cart as $key => $carts) {
                   
                    $product_price = 0;
                    $product = Product::where('id',$carts->product_id)->first();
                
                    $size = ProductSize::where('id', $carts->size_id)->first();
                
                    $cartData[]=[
                        'cart_id' => $carts->id,
                        'product_id' => $carts->product_id,
                        'product_name' => $product->name,
                        'product_image' =>  $product->main_image,
                        'size_name' => $size->name,
                        'price' => $size->customer_price,
                        'quantity' => $carts->quantity,
                    ];
                }                
            }
        }else{            
            
            if (Session::has('cart') && !empty(Session::get('cart'))) {
                $cart = Session::get('cart');
                if (count($cart) > 0) {
                    foreach ($cart as $product_id => $value1) {
                        $product_price = 0;
                        $product = Product::where('id',$product_id)->first();
                    
                        $size = ProductSize::where('id', $value1['size_id'])->first();
                    
                        $cartData[]=[
                            'cart_id' => $product_id,
                            'product_id' => $product_id,
                            'product_name' => $product->name,
                            'product_image' =>  $product->main_image,
                            'size_name' => $size->name,
                            'price' => $size->customer_price,
                            'quantity' => $value1['quantity'],
                        ];
                    }
                }
            }
        }
        // dd($cartData);
        return view('web.cart.cart',compact('cartData'));
    }
   
    public function cartUpdate($cart_id,$quantity)
    {
        if (Auth::check() && !empty(Auth::user()->id)) {
            $user_id = Auth::user()->id;

            $updateCart = Cart::where('id',$cart_id)
            ->update([
                'quantity' => $quantity
            ]);
            return redirect()->back();
        }elseif(Session::has('cart') && !empty(Session::get('cart'))){
            $cart = Session::get('cart');
            $item = $cart[$cart_id]['quantity'] = $quantity;

            Session::put('cart', $cart);
            Session::save();
            return redirect()->back();
        }
    }
 
    public function cartRemove($cart_id)
    {
        if( Auth::check() && !empty(Auth::user()->id)) {
            Cart::where('id',$cart_id)->delete();
        }else{
            Session::forget('cart.'.$cart_id);
        }
        return redirect()->back();
    }
}
