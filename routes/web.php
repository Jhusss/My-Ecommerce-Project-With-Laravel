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




// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'IndexController@index' )->name('front');
Route::get('/category/{url}','AdminProductsController@category')->name('category.list');
Route::get('/products/{url}','AdminProductsController@products')->name('products.list');
Route::get('/product/{id}', 'AdminProductsController@product')->name('products.details');
Route::post('/search-products', 'AdminProductsController@searchProducts');


//All routes after login
Route::group(['middleware' => 'frontlogin'],function(){
        
    //user account
    Route::post('/update-user-pwd', 'UsersController@updatePassword')->name('update-user-pwd');
    Route::post('/check-user-pwd', 'UsersController@chkUserPassword');
    Route::match(['get','post'], '/account', 'UsersController@account')->name('account-user');
    //checkout 
    Route::match(['get','post'], '/checkout', 'AdminProductsController@checkout')->name('checkout');  
    //Order review Page
    Route::match(['get','post'], '/order-review', 'AdminProductsController@orderReview')->name('order-review');
    //Place order
    Route::match(['get', 'post'], 'place-order', 'AdminProductsController@placeOrder')->name('place-order');
    //Thanks Page
    Route::get('/thanks', 'AdminProductsController@thanks')->name('thanks');
    //Paypal Page
    Route::get('/paypal', 'AdminProductsController@paypal')->name('paypal');
    //Order page
    Route::get('/orders', 'AdminProductsController@userOrders')->name('orders');
    // User Ordered Products Page
    Route::get('/orders/{id}', 'AdminProductsController@userOrderDetails')->name('order->details');
});
//login and register front-page
Route::get('/login-register','UsersController@userLoginRegister')->name('login-register-user');

//forgot password
Route::match(['get', 'post'],'forgot-password', 'UsersController@forgotPassword')->name('forgot-password');

//Confirm account
Route::get('confirm/{code}','UsersController@confirmAccount');

//logout user and login user
Route::get('user-logout', 'UsersController@logout')->name('logout-user');
Route::post('user-login', 'UsersController@login')->name('login-user');

//user register
Route::post('/user-register','UsersController@register')->name('user-register');

//check email
Route::match(['get', 'post'], '/check-email','UsersController@checkEmail');

//Get product attribute price
Route::get('/get-product-price','AdminProductsController@getProductPrice');
Route::get('/get-product-price1','AdminProductsController@getProductPrice');

//cart page
Route::match(['get', 'post'], '/cart', 'AdminProductsController@cart')->name('cart');

//Add to cart
Route::match(['get', 'post'], '/add-cart', 'AdminProductsController@addtocart')->name('add-cart');
//Delete product from cart
Route::get('/cart/delete-product/{id}', 'AdminProductsController@deleteCartProduct')->name('deleteCartProduct');
//Cart quantity update
Route::get('/cart/update-quantity/{id}/{quantity}', 'AdminProductsController@updateCartQuantity')->name('update-cart-quantity');




//Admin Login Page


Route::match(['get','post'],'admin', 'AdminController@login')->name('admin');
Route::group(['middleware' => 'adminLogin'], function () {
    
    Route::get('admin/dashboard', 'AdminController@dashboard')->name('admin.index');
    Route::get('admin/settings', 'AdminController@settings');
    Route::get('admin/chk-pwd', 'AdminController@chkPassword');
    Route::match(['get','post'], 'admin/update-pwd', 'AdminController@updatePassword');
    Route::get('/logout', 'AdminController@logout')->name('logout-admin');
    Route::resource('admin/products', 'AdminProductsController')->except('show');
    Route::get('admin/products/{slug}', 'AdminProductsController@show')->name('products.show');
    Route::resource('categories', 'AdminCategoriesController')->except(['create','show']);
    Route::resource('users', 'AdminUsersController')->except('show');
    Route::match(['get', 'post'], 'admin/products/add-attributes/{product}', "AdminProductsController@addAttributes")->name('products.add-attributes');
    Route::match(['get', 'post'], 'admin/products/add-alternate-img/{product}', "AdminProductsController@addAlternateImages")->name('products.add-alternate-img');
    Route::match(['get', 'post'], 'admin/products/edit-attributes/{product}', "AdminProductsController@editAttributes")->name('products.edit-attributes');
    Route::delete('admin/products/destroy-attribute/{id}', "AdminProductsController@destroyAttribute")->name('products.destroy-attribute');
    Route::delete('admin/products/destroy-alternate-img/{productimage}', "AdminProductsController@destroyAlternateImages")->name('products.destroy-alternate-images');
    Route::resource('banners', 'AdminBannersController');
    Route::get('admin/view-orders', 'AdminProductsController@viewOrders')->name('view-orders');
    Route::get('admin/view-order/{id}', 'AdminProductsController@viewOrderDetails')->name('view-order-details');
    Route::get('admin/view-order-invoice/{id}', 'AdminProductsController@viewOrderInvoice')->name('view-order-invoice');
    Route::post('admin/update-order-status','AdminProductsController@updateOrderStatus')->name('update-order-status');
    Route::match(['get','post'], 'admin/add-cms-page','CmsController@addCmsPage')->name('add-cms-page');
    Route::get('admin/view-cms-pages', 'CmsController@viewCmsPages')->name('view-cms-pages');
});



