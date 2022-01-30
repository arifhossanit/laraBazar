<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\backend\ProductManageController;
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
});
Route::view('/register','pages.register');
Route::post('/register', [UserController::class,'register']);
Route::view('/login','pages.login');
Route::post('/login', [UserController::class,'login']);
Route::get('/', [ProductController::class,'index']);
Route::get('detail/{id}', [ProductController::class,'detail']);
Route::get('search', [ProductController::class,'search']);
Route::post('add_to_cart', [ProductController::class,'addToCart']);
Route::get('/cartlist', [ProductController::class,'cartList']);
Route::get('/removeitem/{id}', [ProductController::class,'removeCart']);
Route::get('/checkout', [ProductController::class,'checkOut']);
Route::post('/orderplace', [ProductController::class,'orderPlace']);
Route::view('/about','pages.about');
Route::view('/contact','pages.contact');

Route::get('/admin',[ProductManageController::class,'index']);
Route::get('/productlist', [ProductManageController::class,'productList']);
Route::view('/addproduct','backend.pages.add_product');
Route::post('/addproduct', [ProductManageController::class,'addProduct']);
Route::get('/delproduct/{id}', [ProductManageController::class,'delProduct']);