<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\Admin\ApartementController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GouvernementController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\RoomController;
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
        Route::any('/update/{id}', [HotelController::class, 'update'])->name('updateHotel');
        Route::any('/create', [HotelController::class, 'create'])->name('createHotel');
        Route::any('/store', [HotelController::class, 'store'])->name('storeHotel');
        Route::any('/delete/{id}', [HotelController::class, 'destroy'])->name('deleteHotel');
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