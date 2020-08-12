<?php

use Illuminate\Http\Request;

Route::group(['namespace' => 'Admin'],function(){
    Route::get('/admin/login','LoginController@index')->name('admin.login_form');    
    Route::post('login', 'LoginController@adminLogin');

 
    Route::group(['middleware'=>'role:admin','prefix'=>'admin'],function(){
        Route::get('/dashboard', 'DashboardController@dashboardView')->name('admin.deshboard');        
        Route::post('logout', 'LoginController@logout')->name('admin.logout');
        Route::get('/change/password/form', 'DashboardController@changePasswordForm')->name('admin.change_password_form');
        Route::post('/change/password', 'DashboardController@changePassword')->name('admin.change_password');

        Route::group(['prefix'=>'category'],function(){
            Route::get('list','CategoriesController@mainCategoryList')->name('admin.main_category_list');
            Route::get('add/form', 'CategoriesController@mainCategoryAddForm')->name('admin.main_category_add_form');        
            Route::post('insert/form', 'CategoriesController@mainCategoryInsertForm')->name('admin.main_category_insert_form');
            Route::get('status/{id}/{status}', 'CategoriesController@mainCategoryStatus')->name('admin.main_category_status');
            Route::get('edit/{id}', 'CategoriesController@mainCategoryEdit')->name('admin.main_category_edit');
            Route::put('update/{id}', 'CategoriesController@mainCategoryUpdate')->name('admin.main_category_update');
        });

        Route::group(['prefix'=>'sub/category'],function(){        
            Route::get('list','CategoriesController@subCategoryList')->name('admin.sub_category_list');
            Route::get('add/form', 'CategoriesController@subCategoryAddForm')->name('admin.sub_category_add_form');        
            Route::post('insert/form', 'CategoriesController@subCategoryInsertForm')->name('admin.sub_category_insert_form');    
            Route::get('edit/{id}', 'CategoriesController@subCategoryEdit')->name('admin.sub_category_edit');
            Route::put('update/{id}', 'CategoriesController@subCategoryUpdate')->name('admin.sub_category_update');
            Route::get('list/with/category/{category_id}', 'CategoriesController@subCategoryListWithCategory')->name('admin.sub_category_list_with_category');
        });

        Route::group(['prefix'=>'brands'],function(){       
            Route::get('add/form','BrandController@AddForm')->name('admin.brand_add_form');
            Route::post('insert/form', 'BrandController@BrandInsertForm')->name('admin.brand_insert');
            Route::get('list','BrandController@brandList')->name('admin.brand_list');
            Route::get('status/{id}/{status}', 'BrandController@brandStatus')->name('admin.brand_status');
            Route::get('edit/{id}', 'BrandController@brandEdit')->name('admin.brand_edit');
            Route::put('update/{id}', 'BrandController@brandUpdate')->name('admin.brand_update');
            Route::get('list/with/category/{category_id}', 'BrandController@brandListWithCategory')->name('admin.brand_list_with_category');
        });

        Route::group(['prefix'=>'product'],function(){       
            Route::get('add/form','ProductController@AddForm')->name('admin.product_add_form');
            Route::post('insert','ProductController@insertProduct')->name('admin.product_insert');
            Route::get('list','ProductController@productList')->name('admin.product_list');
            Route::get('list/ajax','ProductController@productListAjax')->name('admin.product_list_ajax');
            Route::get('view/{id}','ProductController@productView')->name('admin.product_view');
            Route::get('edit/{id}','ProductController@productEdit')->name('admin.product_edit');
            Route::post('update','ProductController@productUpdate')->name('admin.product_update');
            Route::get('status/update/{id}/{status}','ProductController@productStatusUpdate')->name('admin.product_status_update');

            Route::get('edit/sizes/{product_id}','ProductController@editSizes')->name('admin.product_edit_sizes');
            Route::post('add/new/sizes/','ProductController@addNewSize')->name('admin.product_add_new_sizes');
            Route::post('update/sizes/','ProductController@updateSize')->name('admin.product_update_sizes');
            
            Route::get('edit/specifications/{product_id}','ProductController@editSpecifications')->name('admin.product_edit_specifications');
            Route::post('add/new/specofication/','ProductController@addNewSpecification')->name('admin.product_add_new_specofication');
            Route::post('update/specofication/','ProductController@updateSpecification')->name('admin.product_update_specofication');
            Route::get('delete/specofication/{sp_id}','ProductController@deleteSpecification')->name('admin.product_delete_specofication');

            Route::get('edit/images/{product_id}','ProductController@editImages')->name('admin.product_edit_images');
            Route::post('add/new/images/','ProductController@addNewImages')->name('admin.product_add_new_images');            
            Route::get('make/cover/image/{image_id}','ProductController@makeCoverImage')->name('admin.product_make_cover_image');            
            Route::get('delete/image/{image_id}','ProductController@deleteImage')->name('admin.product_delete_image');
        });

        Route::group(['prefix'=>'user'],function(){
            Route::get('customer/list','UsersController@customerList')->name('admin.customer_list');            
            Route::get('retailer/list','UsersController@retailerList')->name('admin.retailer_list');
        });

        Route::group(['prefix'=>'order'],function(){
            Route::get('/list','OrderController@orderList')->name('admin.order_list');            
            Route::get('/list/ajax','OrderController@orderListAjax')->name('admin.order_list_ajax');
        });
        
    });
});
