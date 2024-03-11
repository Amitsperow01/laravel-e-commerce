<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BlockController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ManageCustomerController;
use App\Http\Controllers\Admin\ManageOrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group([],function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('enquiry.store', [EnquiryController::class, 'store'])->name('enquiry.store');
    
    
    Route::get('contact', [HomeController::class, 'contact'])->name('contact');
    Route::get('admin', [LoginController::class, 'index'])->name('login');
    Route::post('admin/login', [LoginController::class, 'login'])->name('login.post');
    Route::get('/category/{url_key}', [HomeController::class, 'categories'])->name('category.data');
Route::get('/product/{url_key}', [HomeController::class, 'product'])->name('product.data');

Route::post('cart/store/{id}', [CartController::class, 'addToCart'])->name('cart.store');
Route::get('cart', [CartController::class, 'viewCart'])->name('cart');
// cart delete
Route::delete('cart/delete/{id}', [CartController::class, 'cartDelete'])->name('cart.delete');
Route::post('cart/update/{id}', [CartController::class,'cartUpdate'])->name('cart.update');

// coupon apply
Route::post('coupon/apply', [CartController::class, 'couponApply'])->name('coupon.apply');
Route::get('coupon/cancel/{id}', [CartController::class,'couponCancel'])->name('coupon.cancel');

Route::get('cart/checkout', [CheckoutController::class,'checkoutPage'])->name('cart.checkout');
Route::post('cart/order', [CheckoutController::class,'store'])->name('cart.checkout.store');
Route::get('checkout/success', [CheckoutController::class,'success'])->name('checkout.success');
//customer create
Route::get('customer/create', [CustomerController::class,'index'])->name('customer.create');
Route::post('customer/store', [CustomerController::class,'store'])->name('customer.store');
Route::get('customer/login', [CustomerController::class,'login'])->name('customer.login');
Route::post('customer/authenticate', [CustomerController::class,'authenticate'])->name('customer.authenticate');
Route::get('customer/profile', [CustomerController::class,'profile'])->name('customer.profile');
Route::post('customer/updateAddress', [CustomerController::class,'updateOrCreateAddress'])->name('customer.updateAddress');
Route::post('customer/update', [CustomerController::class,'update'])->name('customer.update');
Route::post('customer/logout', [CustomerController::class,'logout'])->name('customer.logout');

Route::post('wishlist/store', [WishlistController::class,'storeWishlist'])->name('wishlist.store');
    Route::get('wishlist/destory/{id}', [WishlistController::class,'destory'])->name('wishlist.destory');

//admin customer manage
Route::get('managecustomer',[ManageCustomerController::class,'index'])->name('Manage.Customer');

Route::get('/{urlkey}', [HomeController::class, 'page'])->name('page');

});


Route::group(['prefix' => 'admin', 'middleware' => ['auth','front_user']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('user', UserController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);
    Route::resource('page', PageController::class);
    Route::resource('block', BlockController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('product', ProductController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('attribute', AttributeController::class);
    Route::resource('coupon', CouponController::class);
    Route::post('ckeditor/upload', [PageController::class, 'upload'])->name('ckeditor.upload');
    Route::post('ckeditor/upload', [BlockController::class, 'upload'])->name('ckeditor.upload');
    Route::get('enquiry', [EnquiryController::class, 'index'])->name('enquiry');
    Route::get('manageorder', [ManageOrderController::class, 'index'])->name('manageorder');
    Route::get('order/detail/{id}', [ManageOrderController::class, 'show'])->name('order.show');
    Route::post("enqry.status", [EnquiryController::class, 'status'])->name('enqry.status');
    Route::delete("enqry.destroy{id}", [EnquiryController::class, 'destroy'])->name('enqry.destroy');
});

