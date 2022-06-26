<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaxiController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrdersController;
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



Auth::routes();

// ->middleware(['auth', 'verified']);
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

Route::group(['prefix' => 'cars'/*, 'middleware' => 'auth' */], function () {
    Route::get('/', [CarController::class, 'userIndex'])->name('userIndexCar');
    Route::get('/getcars', [CarController::class, 'carApi'])->name('getallcarsapi');
    Route::group(['middleware' => 'auth'], function () {
        Route::get('carDetails/{id}', [CarController::class, 'oneCar'])->name('userOneCar');
        Route::post('checkordercar', [CarController::class, 'checkordercar'])->name('checkordercar');
        Route::post('confirmordercar', [CarController::class, 'confirmordercar'])->name('confirmordercar');
    });
});
Route::group(['prefix' => 'taxis'], function () {
    Route::get('/', [TaxiController::class, 'userIndex'])->name('userIndexTax');
    Route::get('/taxApi', [TaxiController::class, 'taxApi'])->name('taxApi');
    Route::group(['middleware' => 'auth'], function () {
        Route::post('getpricedestination', [TaxiController::class, 'getpricedestination'])->name('getpricedestination');
        Route::get('detailsTaxi/{id}', [TaxiController::class, 'oneTaxi'])->name('userOneTax');
        Route::post('checkordertaxi', [TaxiController::class, 'checkorder'])->name('checkordertaxi');
        Route::post('confirmorder', [TaxiController::class, 'confirmorder'])->name('confirmordertaxi');
    });
});


Route::group(['prefix' => 'hotels'], function () {
    Route::get('/', [HotelController::class, 'userIndex'])->name('userIndexhotel');
    Route::get('/getAllHotelsForUser', [HotelController::class, 'getAllHotelsForUser'])->name('getAllHotelsForUser');
    Route::get('/hotelsorderd/{govId}', [HotelController::class, 'hotelsordered'])->name('hotelsordered');
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/rooms/{id}', [HotelController::class, 'getRoomsByHotelId'])->name('getRoomsByHotelId');
        Route::get('hoteldetail/{id}', [HotelController::class, 'hoteldetail'])->name('hoteldetail');
        Route::any('/hotelorder/{hotelId}', [HotelOrderController::class, 'order'])->name('hotelorder');
        Route::any('/storeorder/{hotelId}/{roomId}', [HotelOrderController::class, 'store'])->name('sotororderhoter');
    });
});
Route::group(['prefix' => 'Apartement'], function () {
    Route::get('/apartorderd/{govId}', [ApartementController::class, 'Apartordered'])->name('Apartordered');
    Route::get('/', [ApartementController::class, 'userIndex'])->name('userIndexApartement');
    Route::get('/apartementApi', [ApartementController::class, 'apartementApi'])->name('apartementApi');
    Route::group(['middleware' => 'auth'], function () {
        Route::get('userOneApartement/{id}', [ApartementController::class, 'oneApartement'])->name('userOneApartement');
        Route::post('checkorderapartement', [ApartementController::class, 'checkorderapartement'])->name('checkorderapartement');
        Route::post('confirmorder', [ApartementController::class, 'confirmorderapart'])->name('confirmorderapart');
    });
});

Route::group(['prefix' => 'villa'], function () {
    Route::get('/villaorderd/{govId}', [VillaController::class, 'Villaordered'])->name('Villaordered');
    Route::get('/', [VillaController::class, 'userIndex'])->name('userIndexVilla');
    Route::get('villaApi', [VillaController::class, 'villaApi'])->name('villaApi');
    Route::group(['middleware' => 'auth'], function () {
        Route::get('userOneVilla/{id}', [VillaController::class, 'oneVilla'])->name('userOneVilla');
        Route::post('checkordervilla', [VillaController::class, 'checkordervilla'])->name('checkordervilla');
        Route::post('confirmordervilla', [VillaController::class, 'confirmordervilla'])->name('confirmordervilla');
    });
});


Route::group(['prefix' => 'meeting'], function () {
    Route::get('/', [MeetingSallesController::class, 'userindex'])->name('meetinguserindex');
    Route::get('meeting', [MeetingSallesController::class, 'meetingApi'])->name('meetingaApi');
    Route::group(['middleware' => 'auth'], function () {
        Route::get('userOneRoomMeet/{id}', [MeetingSallesController::class, 'oneMeetingRoom'])->name('oneMeetingRoom');
        Route::post('orderCheck', [MeetingSallesController::class, 'checkOrder'])->name('meetCheckOrder');
        Route::post('saveOrder', [MeetingSallesController::class, 'saveOrder'])->name('meetsaveOrder');
    });
});


Route::group(['prefix' => 'orders', 'middleware' => 'auth'], function () {
    Route::get('/hotelOrders', [OrdersController::class, 'userHotelOrder'])->name('userHotelOrder');
    Route::any('/singleorderhotel/{id}', [OrdersController::class, 'showOneOrderFoUser'])->name('singlehotelOrder');
    Route::get('/carOrders', [OrdersController::class, 'userCarOrder'])->name('userCarOrder');
    Route::get('/singlecarOrder/{id}', [OrdersController::class, 'singleCarOrder'])->name('singlecarOrder');
    Route::get('/taxiOrders', [OrdersController::class, 'userTaxiOrder'])->name('userTaxiOrder');
    Route::get('/singleTaxOrder/{id}', [OrdersController::class, 'singleTaxOrder'])->name('singleTaxOrder');
    Route::get('/meetingOrders', [OrdersController::class, 'userMeetOrder'])->name('userMeetOrder');
    Route::get('/singleMeetOrders/{id}', [OrdersController::class, 'singleMeetOrder'])->name('singleMeetOrder');
    Route::get('/appartOrders', [OrdersController::class, 'userAppartOrder'])->name('userAppartOrder');
    Route::get('/singleappartOrder/{id}', [OrdersController::class, 'singleApartOrder'])->name('singleApartOrder');
    Route::get('/villaOrders', [OrdersController::class, 'userVillaOrder'])->name('userVillaOrder');
    Route::get('/singleVillaOrder/{id}', [OrdersController::class, 'singleVillaOrder'])->name('singleVillaOrder');
});
