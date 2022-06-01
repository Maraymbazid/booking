<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\VillaController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ApartementController;
use App\Http\Controllers\SubServicesHotelController;
use App\Http\Controllers\Admin\GouvernementController;
use App\Http\Controllers\Admin\MeetingSallesController;
use App\Http\Controllers\TaxiController;

Route::group(['middleware' => 'guest:admin'], function() {
    Route::get('login', [AdminController::class, 'getlogin'])->name('get.admin.login');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login');
});
Route::group(['middleware'=>'auth:admin'],function() {
    Route::get('/', function(){
        return View('admin.layouts.lay');
    });
    Route::get('allgouvernement', [GouvernementController::class, 'index'])->name('allgouvernement');
    Route::get('actionresponse', [GouvernementController::class, 'action'])->name('actionresponse');
    Route::get('creategouvernement', [GouvernementController::class, 'create'])->name('creategouvernement');
    Route::post('storegouvernement', [GouvernementController::class, 'store'])->name('storegouvernement');
    Route::get('editgouvernement/{id}', [GouvernementController::class, 'edit'])->name('editgouvernement');
    Route::post('updategouvernement', [GouvernementController::class, 'update'])->name('updategouvernement');
    Route::post('delete-gouvernement', [GouvernementController::class, 'delete'])->name('delete-gouvernement');
    Route::post('edit-gouvernement', [GouvernementController::class, 'edit'])->name('edit-gouvernement');
    Route::group(['prefix' => 'holels'], function () {
        Route::any('/', [HotelController::class, 'index'])->name('Hotels');
        Route::any('/edit/{id}', [HotelController::class, 'edit'])->name('editHotel');
        Route::any('/update', [HotelController::class, 'update'])->name('updateHotel');
        Route::any('/create', [HotelController::class, 'create'])->name('createHotel');
        Route::any('/store', [HotelController::class, 'store'])->name('storeHotel');
        Route::any('/delete/{id}', [HotelController::class, 'destroy'])->name('deleteHotel');
        Route::any('/getSubByMainId', [SubServicesHotelController::class, 'getSubByMainId'])->name('getSubByMainId');
        Route::any('/getOneSub/{id}', [SubServicesHotelController::class, 'getOneSub'])->name('getOneSub');
        Route::any('/getSubsByHotelId/{id}', [SubServicesHotelController::class, 'getSubsByHotelId'])->name('getSubsByHotelId');
        Route::any('/deletSub/{id}', [SubServicesHotelController::class, 'deletSub'])->name('deletSub');
        Route::any('/rtoreSub', [SubServicesHotelController::class, 'store'])->name('storeSub');
    });
    Route::group(['prefix' => 'apartement'], function () {
        Route::get('/allapartements', [ApartementController::class, 'index'])->name('allapartements');
        Route::get('/create', [ApartementController::class, 'create'])->name('createapartement');
        Route::post('/store', [ApartementController::class, 'store'])->name('storeapartement');
        Route::post('delete-apartement', [ApartementController::class, 'delete'])->name('delete-apartement');
        Route::get('editapartement/{id}', [ApartementController::class, 'edit'])->name('editapartement');
        Route::post('updateapartement', [ApartementController::class, 'update'])->name('updateapartement');
    });
    Route::group(['prefix' => 'services'], function () {
        Route::get('/allservices', [ServiceController::class, 'index'])->name('allservices');
        Route::get('/create', [ServiceController::class, 'create'])->name('createservice');
        Route::post('/store', [ServiceController::class, 'store'])->name('storeservice');
        Route::post('delete-service', [ServiceController::class, 'delete'])->name('delete-service');
        Route::get('editservice/{id}', [ServiceController::class, 'edit'])->name('editservice');
        Route::post('updateservice', [ServiceController::class, 'update'])->name('updateservice');
      // Route::get('test', [HotelController::class, 'test'])->name('test');
      // Route::get('test', [ServiceController::class, 'test'])->name('test');
    });
    Route::group(['prefix' => 'room'], function () {
        Route::get('/allrooms', [RoomController::class, 'index'])->name('allrooms');
        Route::get('/create', [RoomController::class, 'create'])->name('createroom');
        Route::post('/store', [RoomController::class, 'store'])->name('storeroom');
        Route::post('delete-rooom', [RoomController::class, 'delete'])->name('delete-room');
        Route::get('editroom/{id}', [RoomController::class, 'edit'])->name('editroom');
        Route::post('updateroom', [RoomController::class, 'update'])->name('update-room');
    });
    Route::group(['prefix' => 'villa'], function () {
        Route::get('/allvillas', [VillaController::class, 'index'])->name('allvillas');
        Route::get('/create', [VillaController::class, 'create'])->name('createvilla');
        Route::post('/store', [VillaController::class, 'store'])->name('storevilla');
        Route::post('delete-villa', [VillaController::class, 'delete'])->name('delete-villa');
        Route::get('editvilla/{id}', [VillaController::class, 'edit'])->name('editvilla');
        Route::post('updatevilla', [VillaController::class, 'update'])->name('update-villa');
    });
    Route::group(['prefix' => 'meetingroom'], function () {
        Route::get('/allmeetingroom', [MeetingSallesController::class, 'index'])->name('allmeetingroom');
        Route::get('/create', [MeetingSallesController::class, 'create'])->name('createmeetingroom');
        Route::post('/store', [MeetingSallesController::class, 'store'])->name('storesalle');
        Route::post('delete-meetingroom', [MeetingSallesController::class, 'delete'])->name('delete-meetingroom');
        Route::get('editmeetingroom/{id}', [MeetingSallesController::class, 'edit'])->name('editmeetingroom');
        Route::post('updatemeetingroom', [MeetingSallesController::class, 'update'])->name('update-meetingroom');
    });
    Route::group(['prefix' => 'company'], function () {
        Route::get('/create', [CompanyController::class, 'create'])->name('createCompany');
        Route::post('/store', [CompanyController::class, 'store'])->name('companyStore');
    });
    Route::group(['prefix' => 'cars'], function () {
        Route::get('/create', [CarController::class, 'create'])->name('createCar');
        Route::get('/edit/{id}', [CarController::class, 'edit'])->name('editcar');
        Route::any('/update', [CarController::class, 'update'])->name('updateCar');
        Route::get('/', [CarController::class, 'index'])->name('carindex');
        Route::post('/store', [CarController::class, 'store'])->name('CarStore');
    });
    Route::group(['prefix' => 'taxis'], function () {
        Route::get('/create', [TaxiController::class, 'create'])->name('createTaxi');
        Route::get('/edit/{id}', [TaxiController::class, 'edit'])->name('editTaxi');
        Route::post('/store', [TaxiController::class, 'store'])->name('storeTaxi');
        Route::any('/update', [TaxiController::class, 'update'])->name('updateTax');

        Route::get('/', [TaxiController::class, 'index'])->name('indexTaxi');

    });
});

Route::get('/home',  function()
{
    return view('admin.layouts.lay');
})->name('home');
// Route::get('/test',  function()
// {
//     return view('test');
// });
//Route::get('/create', [RoomController::class, 'create'])->name('createroom');
