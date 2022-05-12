<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GouvernementController;
Route::group(['middleware' => 'guest:admin'], function() {
    Route::get('login', [AdminController::class, 'getlogin'])->name('get.admin.login');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login');
});
Route::group(['middleware'=>'auth:admin'],function() {
    Route::get('allgouvernement', [GouvernementController::class, 'index'])->name('allgouvernement');
    Route::get('actionresponse', [GouvernementController::class, 'action'])->name('actionresponse');
    Route::get('creategouvernement', [GouvernementController::class, 'create'])->name('creategouvernement');
    Route::post('storegouvernement', [GouvernementController::class, 'store'])->name('storegouvernement');
    Route::get('editgouvernement/{id}', [GouvernementController::class, 'edit'])->name('editgouvernement');
    Route::post('updategouvernement', [GouvernementController::class, 'update'])->name('updategouvernement');
    Route::post('delete-gouvernement', [GouvernementController::class, 'delete'])->name('delete-gouvernement');
    Route::post('edit-gouvernement', [GouvernementController::class, 'edit'])->name('edit-gouvernement');
}); 

Route::get('/home',  function()
{
    return view('admin.layouts.dashboard');
})->name('home');
Route::get('/test',  function()
{
    return view('test');
});