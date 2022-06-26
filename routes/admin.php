<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\TaxiController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\Admin\DiscountHotel;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\HotelOrderController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\VillaController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ApartementController;
use App\Http\Controllers\SubServicesHotelController;
use App\Http\Controllers\Admin\GouvernementController;
use App\Http\Controllers\Admin\DiscountVillaController;
use App\Http\Controllers\Admin\MeetingSallesController;
use App\Http\Controllers\Admin\DiscountApartementController;
use App\Http\Controllers\Admin\DiscountCarController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\PromoCodeController;
use App\Http\Controllers\Admin\DiscountSalleController; 
Route::group(['middleware' => 'guest:admin'], function () {
    Route::get('login', [AdminController::class, 'getlogin'])->name('get.admin.login');
    Route::post('login', [AdminController::class, 'login'])->name('admin.login');
});
Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('allusers', [AdminController::class, 'users'])->name('allusers'); 
    Route::post('disableuser', [AdminController::class, 'disableuser'])->name('disable-user');
    Route::post('enableuser', [AdminController::class, 'enableuser'])->name('enable-user');
     Route::get('/adminHome',function()
    {
        return view('admin.layouts.lay');
    })->name('adminHome');
    Route::group(['prefix' => 'gouvernement'], function () {
        Route::get('allgouvernement', [GouvernementController::class, 'index'])->name('allgouvernement');
        Route::get('actionresponse', [GouvernementController::class, 'action'])->name('actionresponse');
        Route::get('creategouvernement', [GouvernementController::class, 'create'])->name('creategouvernement');
        Route::post('storegouvernement', [GouvernementController::class, 'store'])->name('storegouvernement');
        Route::get('editgouvernement/{id}', [GouvernementController::class, 'edit'])->name('editgouvernement');
        Route::post('updategouvernement', [GouvernementController::class, 'update'])->name('updategouvernement');
        Route::post('delete-gouvernement', [GouvernementController::class, 'delete'])->name('delete-gouvernement');
        Route::post('edit-gouvernement', [GouvernementController::class, 'edit'])->name('edit-gouvernement');
    });
    Route::group(['prefix' => 'holels'], function () {
        Route::any('/', [HotelController::class, 'index'])->name('Hotels');
        Route::any('/edit/{id}', [HotelController::class, 'edit'])->name('editHotel');
        Route::any('/showroom/{id}', [HotelController::class, 'showroom'])->name('showroom');
        Route::any('/update', [HotelController::class, 'update'])->name('updateHotel');
        Route::any('/create', [HotelController::class, 'create'])->name('createHotel');
        Route::any('/store', [HotelController::class, 'store'])->name('storeHotel');
        Route::any('/delete/{id}', [HotelController::class, 'destroy'])->name('deleteHotel');
        Route::any('/getSubByMainId', [SubServicesHotelController::class, 'getSubByMainId'])->name('getSubByMainId');
        Route::any('/getOneSub/{id}', [SubServicesHotelController::class, 'getOneSub'])->name('getOneSub');
        Route::any('/getSubsByHotelId/{id}', [SubServicesHotelController::class, 'getSubsByHotelId'])->name('getSubsByHotelId');
        Route::any('/deletSub/{id}', [SubServicesHotelController::class, 'deletSub'])->name('deletSub');
        Route::any('/rtoreSub', [SubServicesHotelController::class, 'store'])->name('storeSub');
        Route::any('/getorders', [HotelOrderController::class, 'adminIndex'])->name('hotelOrders');
        Route::any('/editorderhotel/{id}', [HotelOrderController::class, 'editorderhotel'])->name('editorderhotel');
        Route::any('/updateorderhotel', [HotelOrderController::class, 'updateorderhotel'])->name('updateorderhotel');
        Route::any('deleteorderhotel', [HotelOrderController::class, 'deleteorderhotel'])->name('deleteorderhotel');
        Route::any('showdetailhotel/{id}', [HotelOrderController::class, 'showdetailhotel'])->name('showdetailhotel');
        Route::any('afficherrooms/{id}', [HotelController::class, 'afficherrooms'])->name('afficherrooms');

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
        Route::get('/', [CompanyController::class, 'index'])->name('indexcompany');
        Route::post('delete-company', [CompanyController::class, 'delete'])->name('delete-company');
        Route::get('/edit/{id}', [CompanyController::class, 'edit'])->name('editcompany');
        Route::post('/update', [CompanyController::class, 'update'])->name('updatecompany');
    });
    Route::group(['prefix' => 'cars'], function () {
        Route::get('/create', [CarController::class, 'create'])->name('createCar');
        Route::get('/edit/{id}', [CarController::class, 'edit'])->name('editcar');
        Route::any('/update', [CarController::class, 'update'])->name('updateCar');
        Route::get('/', [CarController::class, 'index'])->name('carindex');
        Route::post('/store', [CarController::class, 'store'])->name('CarStore');
        Route::post('delete-car', [CarController::class, 'delete'])->name('delete-car');
    });
    Route::group(['prefix' => 'promocode'], function () {
        Route::get('/create', [PromoCodeController::class, 'create'])->name('createpromo');
        Route::get('/edit/{id}', [PromoCodeController::class, 'edit'])->name('editpromo');
        Route::post('/update', [PromoCodeController::class, 'update'])->name('updatepromo');
        Route::get('/', [PromoCodeController::class, 'index'])->name('promoindex');
        Route::post('/store', [PromoCodeController::class, 'store'])->name('promostore');
        Route::post('delete-promo', [PromoCodeController::class, 'delete'])->name('delete-promo');
    });
    Route::group(['prefix' => 'taxis'], function () {
        Route::get('/create', [TaxiController::class, 'create'])->name('createTaxi');
        Route::get('/edit/{id}', [TaxiController::class, 'edit'])->name('editTaxi');
        Route::post('/store', [TaxiController::class, 'store'])->name('storeTaxi');
        Route::any('/update', [TaxiController::class, 'update'])->name('updateTaxi');
        Route::get('/', [TaxiController::class, 'index'])->name('indexTaxi');
        Route::post('delete-taxi', [TaxiController::class, 'delete'])->name('delete-taxi');
    }); 
    Route::group(['prefix' => 'destination'], function () {
        Route::get('/alldestination', [DestinationController::class, 'index'])->name('alldestination');
        Route::get('/create', [DestinationController::class, 'create'])->name('createdestination');
        Route::post('/store', [DestinationController::class, 'store'])->name('storedestination');
        Route::post('delete-destination', [DestinationController::class, 'delete'])->name('delete-destination');
        Route::get('editdestination/{id}', [DestinationController::class, 'edit'])->name('editdestination');
        Route::post('updatedestination', [DestinationController::class, 'update'])->name('update-destination');
    });
    Route::group(['prefix' => 'discounthotel'], function () {
        Route::get('/alldiscounthotel', [DiscountHotel::class, 'index'])->name('alldiscounthotel');
        Route::get('/create', [DiscountHotel::class, 'create'])->name('creatediscounthotel');
        Route::post('/store', [DiscountHotel::class, 'store'])->name('storediscounthotel');
        Route::post('/getRoom', [DiscountHotel::class, 'getSubRooms'])->name('getRoom');
        Route::post('/getHotels', [DiscountHotel::class, 'getSubHotels'])->name('getHotels');
        Route::post('/delete-discounthotel', [DiscountHotel::class, 'delete'])->name('delete-discounthotel');
        Route::get('editdiscounthotel/{id}', [DiscountHotel::class, 'edit'])->name('editdiscounthotel');
        Route::post('updatediscounthotel', [DiscountHotel::class, 'update'])->name('updatediscounthotel');
    });
    Route::group(['prefix' => 'discountapartement'], function () {
        Route::get('/alldiscountapartement', [DiscountApartementController::class, 'index'])->name('alldiscountapartement');
        Route::get('/create', [DiscountApartementController::class, 'create'])->name('creatediscountapartement');
        Route::post('/store', [DiscountApartementController::class, 'store'])->name('storediscountapartement');
        Route::post('/getApartement', [DiscountApartementController::class, 'getSubApartements'])->name('getApartement');
        Route::post('/delete-discountapartement', [DiscountApartementController::class, 'delete'])->name('delete-discountapartement');
        Route::get('editdiscountapartement/{id}', [DiscountApartementController::class, 'edit'])->name('editdiscountapartement');
        Route::post('updatediscounthotel', [DiscountApartementController::class, 'update'])->name('updatediscountApartement');
    });
    Route::group(['prefix' => 'discountvilla'], function () {
        Route::get('/alldiscountvilla', [DiscountVillaController::class, 'index'])->name('alldiscountvilla');
        Route::get('/create', [DiscountVillaController::class, 'create'])->name('creatediscountvilla');
        Route::post('/store', [DiscountVillaController::class, 'store'])->name('storediscountvilla');
        Route::post('/getVilla', [DiscountVillaController::class, 'getSubvillas'])->name('getVilla');
        Route::post('/delete-discountvilla', [DiscountVillaController::class, 'delete'])->name('delete-discountvilla');
        Route::get('editdiscountvilla/{id}', [DiscountVillaController::class, 'edit'])->name('editdiscountvilla');
        Route::post('updatediscountvilla', [DiscountVillaController::class, 'update'])->name('updatediscountvilla');
    });
    Route::group(['prefix' => 'discountcar'], function () {
        Route::get('/alldiscountcar', [DiscountCarController::class, 'index'])->name('alldiscountcar');
        Route::get('/create', [DiscountCarController::class, 'create'])->name('creatediscountcar');
        Route::post('/store', [DiscountCarController::class, 'store'])->name('storediscountcar');
        // Route::post('/getVilla', [DiscountVillaController::class, 'getSubvillas'])->name('getVilla');
        Route::post('/delete-discountcar', [DiscountCarController::class, 'delete'])->name('delete-discountcar');
        Route::get('editdiscountcar/{id}', [DiscountCarController::class, 'edit'])->name('editdiscountcar');
        Route::post('updatediscountcar', [DiscountCarController::class, 'update'])->name('updatediscountcar');
    });
    Route::group(['prefix' => 'discountsalle'], function () {
        Route::get('/alldiscountsalle', [DiscountSalleController::class, 'index'])->name('alldiscountsalle');
        Route::get('/create', [DiscountSalleController::class, 'create'])->name('creatediscountsalle');
        Route::post('/store', [DiscountSalleController::class, 'store'])->name('storediscountsalle');
        Route::post('/delete-discountsalle', [DiscountSalleController::class, 'delete'])->name('delete-discountsalle');
        Route::get('editdiscountsalle/{id}', [DiscountSalleController::class, 'edit'])->name('editdiscountsalle');
        Route::post('updatediscountsalle', [DiscountSalleController::class, 'update'])->name('updatediscountsalle');
    });
    Route::group(['prefix' => 'ordercar'], function () {
        Route::get('/allorderscars', [CarController::class, 'getallorders'])->name('allorderscars');
        Route::get('editordercar/{id}', [CarController::class, 'editordercar'])->name('editordercar');
        Route::post('/updateorder', [CarController::class, 'updateorder'])->name('updateorder');
        Route::get('showdetailcar/{id}', [CarController::class, 'show'])->name('showdetailcar');
        Route::post('deleteordercar', [CarController::class, 'deleteordercar'])->name('deleteordercar');
    });
    Route::group(['prefix' => 'ordertaxi'], function () {
        Route::get('/allorderstaxis', [TaxiController::class, 'getallorders'])->name('allorderstaxis');
        Route::get('editordertaxi/{id}', [TaxiController::class, 'editordertaxi'])->name('editordertaxi');
        Route::post('/updateorder', [TaxiController::class, 'updateordertaxi'])->name('updateordertaxi');
        Route::get('showdetailtaxi/{id}', [TaxiController::class, 'showdetailtaxi'])->name('showdetailtaxi');
        Route::post('deleteordertaxi', [TaxiController::class, 'deleteordertaxi'])->name('deleteordertaxi');
    });
    Route::group(['prefix' => 'orderapartement'], function () {
        Route::get('/allordersapartement', [ApartementController::class, 'getallorders'])->name('allordersapartement');
        Route::get('editorderapart/{id}', [ApartementController::class, 'editorderapart'])->name('editorderapart');
        Route::post('/updateorder', [ApartementController::class, 'updateorderapart'])->name('updateorderapart');
        Route::get('showdetailapart/{id}', [ApartementController::class, 'showdetailapart'])->name('showdetailapart');
        Route::post('deleteorderapart', [ApartementController::class, 'deleteorderapart'])->name('deleteorderapart');
    });
    Route::group(['prefix' => 'ordervilla'], function () {
        Route::get('/allordersvilla', [VillaController::class, 'getallorders'])->name('allordersvilla');
        Route::get('editordervilla/{id}', [VillaController::class, 'editordervilla'])->name('editordervilla');
        Route::post('/updateorder', [VillaController::class, 'updateordervilla'])->name('updateordervilla');
        Route::get('showdetailvilla/{id}', [VillaController::class, 'showdetailvilla'])->name('showdetailvilla');
        Route::post('deleteordervilla', [VillaController::class, 'deleteordervilla'])->name('deleteordervilla');
    });
    Route::group(['prefix' => 'ordersalles'], function () {
        Route::get('/allorderssalles', [MeetingSallesController::class, 'getallorders'])->name('allorderssalles');
        Route::get('editordersalles/{id}', [MeetingSallesController::class, 'editordersalle'])->name('editordersalles');
        Route::post('/updateordersalle', [MeetingSallesController::class, 'updateordersalles'])->name('updateordersalle');
        Route::get('showdetailsalles/{id}', [MeetingSallesController::class, 'showdetailsalles'])->name('showdetailsalles');
        Route::post('deleteordersalle', [MeetingSallesController::class, 'deleteordersalle'])->name('deleteordersalle');
    });
});

