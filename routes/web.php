<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Delivery\DeliveryController;
use App\Http\Controllers\Export\ManageController;

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
Route::get('products/delete/item/{id}',[ProductController::class,'delete_item'])->name('delete.item');
Route::resource('deliveries',DeliveryController::class);
Route::get('deliveries/middle/create',[DeliveryController::class,'middle_create'])->name('deliveries.middle_create');
Route::post('deliveries/middle/create/save',[DeliveryController::class,'middle_create_save'])->name('deliveries.middle_create_save');
Route::get('deliveries/finish-order/{id}',[DeliveryController::class,'finish_order'])->name('deliveries.finish.order');
Route::post('deliveries/finish-order/save/{id}',[DeliveryController::class,'finish_order_save'])->name('deliveries.finish.order.save');
Route::get('deliveries/details/{id}',[DeliveryController::class,'show_details'])->name('deliveries.details');
Route::post('deliveries/finish/details-order/{id}',[DeliveryController::class,'finish_details'])->name('finish.details');
Route::get('/save/pdf',[ManageController::class,'export_pdf'])->name('export.pdf');
Route::get('/save/excel',[ManageController::class,'export_excel'])->name('export.excel');

