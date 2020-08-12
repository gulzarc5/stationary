<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Register USer
Route::post('add/Users', 'Web\RegistrationController@registerUser')->name('user.register');



Route::group(['namespace' => 'Web','prefix'=>'user'],function(){
    Route::post('login/submit', 'LoginController@userLogin')->name('web.user_login');
    Route::get('login', 'LoginController@showLogin')->name('web.login');

    
    // Add To Cart
    Route::group(['prefix'=>'cart'],function(){
        Route::post('/add', 'CartController@AddCart')->name('web.add_to_cart');
        Route::get('update/{cart_id}/{quantity}', 'CartController@cartUpdate')->name('web.cart_update');
        Route::get('remove/{cart_id}', 'CartController@cartRemove')->name('web.cart_remove');
        Route::get('/view', 'CartController@viewCart')->name('web.view_cart');
    });


    Route::group(['middleware'=>'role:user'],function(){

        Route::get('/dashboard', 'DashboardController@dashboardView')->name('user.deshboard');        
        Route::post('logout', 'LoginController@logout')->name('user.logout');

        Route::get('checkout','CheckoutController@checkout')->name('web.checkout');
        Route::post('order/place','CheckoutController@OrderPlace')->name('web.order_place');

        Route::post('shipping/add','UserController@shippingAdd')->name('web.shipping_add');
    });
    
});

Route::group(['prefix' => 'product','namespace'=>'Web'],function(){
    Route::get('list/{slug}/{category_id}/{type}','ProductController@list')->name('web.listWithCategory');
    Route::get('list/ajax/{sort?}/{brand?}','ProductController@listAjax')->name('web.listAjax');
    Route::get('details/{slug}/{id}','ProductController@productDetail')->name('web.productDetail');
    Route::get('size/{id}','ProductController@productSizeFetch')->name('web.product_size_fetch');
});

Route::get('/', function () {
    return view('web.index');
})->name('web.index');



Route::get('/Register', function () {
    return view('web.register');
})->name('web.register');




//========= Wishlist =========//

Route::get('/Wishlist', function () {
    return view('web.wishlist.wishlist');
})->name('web.wishlist.wishlist');


Route::get('/Confirm-Order', function () {
    return view('web.checkout.confirm-order');
})->name('web.checkout.confirm-order');

//========= Order =========//

Route::get('/MyOrder', function () {
    return view('web.order.order');
})->name('web.order.order');

//========= Address =========//

Route::get('/Address', function () {
    return view('web.address.address');
})->name('web.address.address');

Route::get('/Edit-Address', function () {
    return view('web.address.edit-address');
})->name('web.address.edit-address');

//========= Password =========//

Route::get('/Change-Password', function () {
    return view('web.password.change-password');
})->name('web.password.change-password');

Route::get('/Forgot-Password', function () {
    return view('web.password.forgot-password');
})->name('web.password.forgot-password');

Route::get('/New-Password', function () {
    return view('web.password.new-password');
})->name('web.password.new-password');

//========= Profile =========//

Route::get('/Profile', function () {
    return view('web.profile.profile');
})->name('web.profile.profile');
