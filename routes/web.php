<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\TaxiController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HotelOrderController;
use App\Http\Controllers\Admin\VillaController;
use App\Http\Controllers\Admin\ApartementController;
use App\Http\Controllers\Admin\MeetingSallesController;

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

Route::get('/tes', function () {
    return view('layout.flay');
});
Route::get('/tes2', function () {
    return view('home2');
});
Auth::routes();
Route::get('/', function () {
    return view('home2');
});
// ->middleware(['auth', 'verified']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth']);

Route::group(['prefix' => 'cars'/*, 'middleware' => 'auth' */], function () {
    Route::get('/', [CarController::class, 'userIndex'])->name('userIndexCar');
    Route::get('/getcars', [CarController::class, 'carApi'])->name('getallcarsapi');
    Route::get('carDetails/{id}', [CarController::class, 'oneCar'])->name('userOneCar');
    Route::post('checkordercar', [CarController::class, 'checkordercar'])->name('checkordercar');
    Route::post('confirmordercar', [CarController::class, 'confirmordercar'])->name('confirmordercar');

});
Route::group(['prefix' => 'taxis'/*, 'middleware' => 'auth'*/], function () {
    Route::get('/', [TaxiController::class, 'userIndex'])->name('userIndexTax');
    Route::get('detailsTaxi/{id}', [TaxiController::class, 'oneTaxi'])->name('userOneTax');
    Route::post('checkordertaxi', [TaxiController::class, 'checkorder'])->name('checkordertaxi');
    Route::post('confirmorder', [TaxiController::class, 'confirmorder'])->name('confirmordertaxi'); 
    Route::post('getpricedestination', [TaxiController::class, 'getpricedestination'])->name('getpricedestination'); 
    // Route::post('checkorder', [TaxiController::class, 'checkorder'])->name('checkorder');
    // Route::post('confirmorder/{taxId}', [TaxiController::class, 'confirmorder'])->name('confirmorder');
    Route::get('/taxApi', [TaxiController::class, 'taxApi'])->name('taxApi');

});
Route::group(['prefix' => 'hotels', 'middleware' => 'auth'], function () {
    Route::get('/', [HotelController::class, 'userIndex'])->name('userIndexhotel');
    Route::get('/getAllHotelsForUser', [HotelController::class, 'getAllHotelsForUser'])->name('getAllHotelsForUser');
    Route::get('/rooms/{id}', [HotelController::class, 'getRoomsByHotelId'])->name('getRoomsByHotelId');
    Route::get('/hotelsorderd/{govId}', [HotelController::class, 'hotelsordered'])->name('hotelsordered');
    Route::get('hoteldetail/{id}', [HotelController::class, 'hoteldetail'])->name('hoteldetail');
    Route::get('/myorders', [HotelOrderController::class, 'userOrder'])->name('userOrder');
    Route::any('/hotelorder/{hotelId}', [HotelOrderController::class, 'order'])->name('hotelorder');
    Route::any('/storeorder/{hotelId}/{roomId}', [HotelOrderController::class, 'store'])->name('sotororderhoter');
    Route::any('/singleorderhotel/{orderId}', [HotelOrderController::class, 'showOneOrderFoUser'])->name('H_O');
});
Route::group(['prefix' => 'Apartement'], function () {
    Route::get('/', [ApartementController::class, 'userIndex'])->name('userIndexApartement');
    Route::get('userOneApartement/{id}', [ApartementController::class, 'oneApartement'])->name('userOneApartement');
    Route::post('checkorderapartement', [ApartementController::class, 'checkorderapartement'])->name('checkorderapartement');
    Route::post('confirmorder', [ApartementController::class, 'confirmorderapart'])->name('confirmorderapart');
    Route::get('/apartementApi', [ApartementController::class, 'apartementApi'])->name('apartementApi');

});
Route::group(['prefix' => 'villa'], function () {
    Route::get('/', [VillaController::class, 'userIndex'])->name('userIndexVilla');
    Route::get('userOneVilla/{id}', [VillaController::class, 'oneVilla'])->name('userOneVilla'); 
    Route::post('checkordervilla', [VillaController::class, 'checkordervilla'])->name('checkordervilla'); 
    Route::post('confirmordervilla', [VillaController::class, 'confirmordervilla'])->name('confirmordervilla');
    Route::get('villaApi', [VillaController::class, 'villaApi'])->name('villaApi');
});

//Route::get('/test', [HotelController::class, 'test'])->name('test');
//     Route::get('userOneVilla/{id}', [VillaController::class, 'oneVilla'])->name('userOneVilla');
//     Route::post('checkorderapartement', [VillaController::class, 'checkordervilla'])->name('checkordervilla');
//     Route::post('VillaController', [VillaController::class, 'confirmordervilla'])->name('confirmordervilla');
Route::group(['prefix' => 'meeting'], function () {
    Route::get('/', [MeetingSallesController::class, 'userindex'])->name('meetinguserindex');
    Route::get('meeting', [MeetingSallesController::class, 'meetingApi'])->name('meetingaApi');
});
//Route::get('/test1', [HotelController::class, 'test1'])->name('test1');
//Route::get('/test', [TaxiController::class, 'test'])->name('test');
