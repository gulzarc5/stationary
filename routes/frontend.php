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

// Add To Cart
Route::get('/add/to/cart/{id}', 'Web\ProductController@getAddToCart')->name('product.add_to_cart');
Route::patch('update-cart', 'Web\ProductController@update');
Route::delete('remove-from-cart', 'Web\ProductController@remove');
Route::get('/shopping-cart', 'Web\ProductController@cart')->name('frontend.cart');

Route::group(['namespace' => 'Web'],function(){
    Route::post('user/login', 'LoginController@userLogin');
    Route::group(['middleware'=>'role:user','prefix'=>'user'],function(){
        Route::get('/dashboard', 'DashboardController@dashboardView')->name('user.deshboard');        
        Route::post('logout', 'LoginController@logout')->name('user.logout');
    });
});

Route::group(['prefix' => 'product','namespace'=>'Web'],function(){
    Route::get('list/{slug}/{category_id}/{type}','ProductController@list')->name('web.listWithCategory');
    Route::get('list/ajax/{sort?}/{brand?}','ProductController@listAjax')->name('web.listAjax');
    Route::get('details/{slug}/{id}','ProductController@productDetail')->name('web.productDetail');
});

Route::get('/', function () {
    return view('web.index');
})->name('web.index');

Route::get('/Login', function () {
    return view('web.login');
})->name('web.login');

Route::get('/Register', function () {
    return view('web.register');
})->name('web.register');

//========= Product =========//

Route::get('/Product-List', function () {
    return view('web.product.shop-list');
})->name('web.product.shop-list');

Route::get('/Product-Detail', function () {
    return view('web.product.shop-detail');
})->name('web.product.shop-detail');

//========= Wishlist =========//

Route::get('/Wishlist', function () {
    return view('web.wishlist.wishlist');
})->name('web.wishlist.wishlist');

//========= Cart =========//
Route::get('/Cart', 'Web\FrontendPagesController@cartPage')->name('web.cart.cart');

//========= Checkout =========//

Route::get('/Checkout', function () {
    return view('web.checkout.checkout');
})->name('web.checkout.checkout');

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
