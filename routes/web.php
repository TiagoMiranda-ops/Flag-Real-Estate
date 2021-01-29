<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PurchaseOfferController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Models\Property;
use App\Models\PurchaseOffer;
use App\Models\User;


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
/*
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
Route::get('/properties/{property_id}', [PropertyController::class, 'show'])->name('properties.show');
Route::get('/properties/{property_id}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
Route::put('/properties/{property_id}', [PropertyController::class, 'update'])->name('properties.update');
*/
Route::resource('/properties', PropertyController::class);

Route::resource('/offers', PurchaseOfferController::class);

Route::resource('/users', UserController::class);




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
