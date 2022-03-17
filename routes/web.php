<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\backend\ProductManageController;
use App\Http\Controllers\backend\AdminController;
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

Route::get('/logout', function () {
    Session::forget('user');
    return view('pages/login');
})->name('user.logout');
Route::view('/register','pages.register')->name('user.register.page');
Route::post('/register', [UserController::class,'register'])->name('user.register');
Route::view('/user_login','pages.login')->name('user.login.page');
Route::post('/user_login', [UserController::class,'login'])->name('user.login');

Route::get('/', [ProductController::class,'index'])->name('home');
Route::get('detail/{id}', [ProductController::class,'detail'])->name('detail');
Route::get('search', [ProductController::class,'search'])->name('search');
Route::post('add_to_cart', [ProductController::class,'addToCart'])->name('add.to.cart');
Route::get('/cartlist', [ProductController::class,'cartList'])->name('cartlist');
Route::get('/removeitem/{id}', [ProductController::class,'removeCart'])->name('removeitem');
Route::get('/checkout', [ProductController::class,'checkOut'])->name('checkout');
Route::post('/orderplace', [ProductController::class,'orderPlace'])->name('orderplace');
Route::view('/about','pages.about')->name('about');
Route::view('/contact','pages.contact')->name('contact');
Route::view('/orderstatus','pages.orderstatus')->name('orderstatus');



// Auth::routes();
Route::group(['prefix'=>'admin'], function(){
    Route::group(['middleware'=>'admin.guest'], function(){
        Route::view('/login','admin.login')->name('admin.login');
        Route::post('/login',[AdminController::class,'login'])->name('admin.auth');
    });
    Route::group(['middleware'=>'admin.auth:admin'], function(){
        // Route::view('/dashboard','backend.pages.dashboard');
        Route::get('/dashboard',[ProductManageController::class,'index'])->name('dashboard');
        Route::get('/deluser/{id}',[ProductManageController::class,'delUser'])->name('del_user');
        Route::get('/orderlist',[ProductManageController::class,'orderList'])->name('orderlist');
        Route::post('/order_status_change',[ProductManageController::class,'orderStatusChange'])->name('osc');
        Route::get('/productlist', [ProductManageController::class,'productList'])->name('productlist');
        Route::view('/addproduct','backend.pages.add_product')->name('addproduct');
        Route::post('/addproduct', [ProductManageController::class,'addProduct'])->name('addedproduct');
        Route::get('/delproduct/{id}', [ProductManageController::class,'delProduct'])->name('delproduct');
        Route::get('/editproduct/{id}', [ProductManageController::class,'editProduct'])->name('editproduct');
        Route::post('/updateproduct', [ProductManageController::class,'updateProduct'])->name('updateproduct');
        Route::get('/logout',[AdminController::class,'logout'])->name('admin.logout');
    });
});