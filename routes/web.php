<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PurchaseOfferController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentController;
use App\Models\Property;
use App\Models\PurchaseOffer;
use App\Models\User;
use App\Models\Appointment;


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

Route::get('/', function () {
    return view('home');
});

Route::resource('/properties', PropertyController::class);


Route::get('/offers/create/{id}', [PurchaseOfferController::class, 'create'])->name('offers.create');
Route::get('/offers/sales', [PurchaseOfferController::class, 'sales'])->name('offers.sales');
Route::resource('/offers', PurchaseOfferController::class, ['except' => ['create', 'sales']]);


Route::resource('/users', UserController::class);


Route::resource('/appointments', AppointmentController::class);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
