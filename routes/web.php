<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\TaxiController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HotelOrderController;
use App\Http\Controllers\Admin\VillaController;

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

Auth::routes();
Route::get('/', function () {
    return view('home');
});
// Route::get('/test', function () {
//     return view('admin.dashboard');
// });
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'cars', 'middleware' => 'auth'], function () {
    Route::get('/', [CarController::class, 'userIndex'])->name('userIndexCar');
    Route::get('carDetails/{id}', [CarController::class, 'oneCar'])->name('userOneCar');
    Route::post('checkordercar', [CarController::class, 'checkordercar'])->name('checkordercar');
    Route::post('confirmordercar', [CarController::class, 'confirmordercar'])->name('confirmordercar');
});
Route::group(['prefix' => 'taxis', 'middleware' => 'auth'], function () {
    Route::get('/', [TaxiController::class, 'userIndex'])->name('userIndexTax');
    Route::get('detailsTaxi/{id}', [TaxiController::class, 'oneTaxi'])->name('userOneTax');
    Route::post('checkorder', [TaxiController::class, 'checkorder'])->name('checkorder');
    Route::post('confirmorder/{taxId}', [TaxiController::class, 'confirmorder'])->name('confirmorder');
});
Route::group(['prefix' => 'hotels', 'middleware' => 'auth'], function () {
    Route::get('/', [HotelController::class, 'userIndex'])->name('userIndexhotel');
    Route::get('/getAllHotelsForUser', [HotelController::class, 'getAllHotelsForUser'])->name('getAllHotelsForUser');
    Route::get('/rooms/{id}', [HotelController::class, 'getRoomsByHotelId'])->name('getRoomsByHotelId');
    Route::get('/hotelsorderd/{govId}', [HotelController::class, 'hotelsordered'])->name('hotelsordered');
    Route::get('hoteldetail/{id}', [HotelController::class, 'hoteldetail'])->name('hoteldetail');
    Route::get('/myorders', [HotelOrderController::class, 'userOrder'])->name('userOrder');
});
Route::group(['prefix' => 'villa', 'middleware' => 'auth'], function () {
    Route::get('/', [VillaController::class, 'userIndex'])->name('userIndexVilla');
});
Route::group(['prefix' => 'hotelOrder', 'middleware' => 'auth'], function () {
    Route::post('/order/{hotelId}', [HotelOrderController::class, 'order'])->name('hotelorder');
    Route::post('/saveOrder/{hotelId}/{roomId}', [HotelOrderController::class, 'store'])->name('sotororderhoter');
});
