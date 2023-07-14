<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Delivery\DeliveryController;

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

Route::get('/', function () {
    return view('home.welcome');
})->name('home');

Route::resource('products',ProductController::class);
Route::resource('deliveries',DeliveryController::class);
Route::get('deliveries/middle/create',[DeliveryController::class,'middle_create'])->name('deliveries.middle_create');
Route::post('deliveries/middle/create/save',[DeliveryController::class,'middle_create_save'])->name('deliveries.middle_create_save');
