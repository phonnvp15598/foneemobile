<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
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

//frontend
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/search', 'HomeController@search');
Route::post('/autocomplete-ajax','HomeController@autocompleteAjax');

//danh mục sản phẩm
Route::get('/brand/{brand_slug}', 'BrandController@showBrandHome');
Route::get('/product', 'ProductController@showProductHome')->name('pages.product');
Route::get('/product/{product_slug}', 'ProductController@detailProduct');
//blog
Route::get('/blog', 'BlogController@showBlogHome');
Route::get('/blog/{blog_slug}', 'BlogController@showBlogDetail');
//cart
Route::post('/save-cart','CartController@saveCart');
Route::get('/show-cart','CartController@showCart');
Route::get('/delete-to-cart/{rowId}','CartController@deleteToCart');
Route::post('/update-cart-quantity','CartController@updateCartQuantity');
//ajax
Route::post('/add-cart-ajax','CartController@addCartAjax');
Route::get('/cart','CartController@cart');
Route::post('/update-cart','CartController@updateCart');
Route::post('/update-cart-product','CartController@updateCartProduct');

Route::get('/delete-cart/{session_id}','CartController@deleteCart');
Route::get('/delete-cart-ajax/{session_id}','CartController@deleteCartAjax');
Route::get('/delete-all-cart','CartController@deleteAllCart');
Route::get('/delete-all-cart-ajax','CartController@deleteAllCartAjax');
Route::get('/history','CustomerController@history')->name('customer.history');
Route::get('/history-detail/{order_id}','CustomerController@historyDetail')->name('customer.history.detail');
Route::get('/order-cancel/{order_id}', 'CustomerController@orderCancel')->name('customer.order.cancel');
//checkout
Route::get('/login','CustomerController@login');
Route::get('/logout','CustomerController@logout');
Route::post('/register-customer','CustomerController@registerCustomer');
Route::post('/login','CustomerController@postLogin');
Route::get('/verify-customer','CustomerController@verifyCustomer')->name('customer.verify.account');

Route::get('/reset-password','CustomerController@getFormReset');
Route::post('/reset-password','CustomerController@sendEmailReset');
Route::get('/change-password','CustomerController@changePassword')->name('link.reset.password');
Route::post('/change-password','CustomerController@saveChangePassword');



Route::get('/checkout','CheckoutController@checkout');
Route::get('/checkout-success','CheckoutController@checkoutSuccess')->name('pages.checkout.checkout_success');

Route::post('/save-checkout-customer','CheckoutController@saveCheckoutCustomer');
Route::post('/order','CheckoutController@order');
Route::post('/select-city','CheckoutController@selectCity');
//comment product
Route::post('/add-comment-product/{product_id}','CommentController@addCommentProduct');
Route::post('/add-comment-reply','CommentController@addCommentReply');
Route::get('/show-comment-reply','CommentController@showCommentReply');

//404
Route::get('/404','AdminController@errorNotFound')->name('admin.error.404');

//backend




Route::group(['prefix' => 'laravel-filemanager'], function () {
    UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::prefix('admin')->group(function(){
    //authentication
    Route::get('/register', 'AdminController@adminRegister')->name('admin.register');
    Route::post('/register', 'AdminController@postAdminRegister')->name('post.admin.register');
    Route::get('/', 'AdminController@index')->name('admin.login');
    Route::post('/login','AdminController@postAdminLogin')->name('post.admin.login');


    Route::get('/logout', 'AdminController@adminLogout')->name('admin.logout');
   
    Route::middleware('CheckLoginAdmin')->group(function () {
        // Route::post('/dashboard', 'AdminController@login')->name('admin.dashboard');
        Route::get('/blank', 'AdminController@showBlank')->name('admin.blank');
        Route::get('/profile', 'AdminController@showProfile')->name('admin.profile');
        Route::post('/update-profile', 'AdminController@updateProfile')->name('admin.profile.update');
        Route::post('/change-password', 'AdminController@changePassword')->name('admin.profile.changepass');
        Route::prefix('brand')->group(function(){
            //brand product
            Route::get('/add', 'BrandController@add')->name('admin.brand.add');
            Route::get('/edit/{brand_id}', 'BrandController@edit')->name('admin.brand.edit');
            Route::get('/delete/{brand_id}', 'BrandController@delete')->name('admin.brand.delete');

            Route::get('/', 'BrandController@index')->name('admin.brand.index');
            Route::post('/save','BrandController@save')->name('admin.brand.save');
            Route::post('/update/{brand_id}','BrandController@update')->name('admin.brand.update');

            Route::get('/active-brand/{brand_id}','BrandController@activeBrand')->name('admin.brand.active');
            Route::get('/unactive-brand/{brand_id}','BrandController@unactiveBrand')->name('admin.brand.unactive');
        });
        Route::middleware('permission.author')->group(function(){
            Route::prefix('blog')->group(function(){
                //blog
                Route::get('/add', 'BlogController@add')->name('admin.blog.add');
                Route::get('/edit/{blog_id}', 'BlogController@edit')->name('admin.blog.edit');
                Route::get('/delete/{blog_id}', 'BlogController@delete')->name('admin.blog.delete');
    
                Route::get('/', 'BlogController@index')->name('admin.blog.index');
                Route::post('/save','BlogController@save')->name('admin.blog.save');
                Route::post('/update/{blog_id}','BlogController@update')->name('admin.blog.update');
    
                Route::get('/active-blog/{blog_id}','BlogController@activeBlog')->name('admin.blog.active');
                Route::get('/unactive-blog/{blog_id}','BlogController@unactiveBlog')->name('admin.blog.unactive');
            });
        });
        Route::middleware('permission.admin')->group(function(){
            Route::get('/dashboard', 'AdminController@showDashboard')->name('admin.dashboard');
            Route::get('/dashboard/revenue', 'AdminController@showRevenue')->name('admin.dashboard.revenue');
            Route::prefix('product')->group(function () {
                //product
                Route::get('/add', 'ProductController@add')->name('admin.product.add');
                Route::get('/edit/{product_id}', 'ProductController@edit')->name('admin.product.edit');
                Route::get('/delete/{product_id}', 'ProductController@delete')->name('admin.product.delete');
                Route::post('/delete-product-selected', 'ProductController@deleteProductSelected')->name('delete.selected');

                Route::get('/', 'ProductController@index')->name('admin.product.index');
                Route::get('/search', 'ProductController@search')->name('admin.product.search');

                Route::post('/save','ProductController@save')->name('admin.product.save');
                Route::post('/update/{product_id}','ProductController@update')->name('admin.product.update');

                Route::get('/active-product/{product_id}','ProductController@activeProduct')->name('admin.product.active');
                Route::get('/unactive-product/{product_id}','ProductController@unactiveProduct')->name('admin.product.unactive');

            });
            Route::prefix('order')->group(function () {
                //order
                Route::get('/', 'ManageOrderController@index')->name('admin.order.index');
                Route::get('/view-order/{order_id}', 'ManageOrderController@viewOrder')->name('admin.order.view');
                Route::post('/update-status/{order_id}', 'ManageOrderController@updateStatus')->name('admin.order.update');
                Route::post('/delete-order-selected', 'ManageOrderController@deleteOrderSelected')->name('delete.order.selected');
                Route::get('/export-order', 'ManageOrderController@exportOrder')->name('admin.order.export');
                Route::get('/export-pdf/{order_id}', 'PDFController@exportOrderPDF')->name('admin.order.pdf');

            });
            Route::prefix('user')->group(function () {
                //manage user
                Route::get('/', 'UserController@index')->name('admin.user.index');
                Route::get('/delete/{id}', 'UserController@delete')->name('admin.user.delete');
                Route::post('/assign-user', 'UserController@assignUser')->name('assign.user');

            });
            Route::prefix('customer')->group(function(){
                Route::get('/', 'CustomerController@index')->name('admin.customer.index');
                Route::get('/delete/{customer_id}', 'CustomerController@delete')->name('admin.customer.delete');
            });

        });


     });

});












