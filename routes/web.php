<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\WeekendController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\VisaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\FrontHotelController;

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

Route::get('/', function(){
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function() {
    
    Route::resource('users',UserController::class);
    Route::get('/users',[UserController::class, 'index'])->name('users.index');
    Route::get('/get_users',[UserController::class, 'get_users']);
    
    Route::resource('packages', PackageController::class);
    Route::get('/get_packages',[PackageController::class, 'get_packages']);

    Route::resource('roles', RoleController::class);

    Route::resource('routes', RouteController::class);
    Route::resource('transports', TransportController::class);
    Route::resource('hotels', HotelController::class);
    Route::get('/get_hotels',[HotelController::class, 'get_hotels']);
    Route::get('/get_tranports',[TransportController::class, 'get_transports']);
    Route::get('/get_routes',[RouteController::class, 'get_routes']);
    Route::get('/weekends', [WeekendController::class, 'index'])->name('weekends.index');
    Route::post('/weekends', [WeekendController::class, 'store'])->name('weekends.store');
    Route::get('/custom_package',[HotelController::class, 'custom_package'])->name('admin.custom_package');
    Route::post('/calculate_package',[HotelController::class, 'calculate_package'])->name('admin.calculate_package');
    Route::get('/currency_conversion',[HotelController::class, 'currency_conversion'])->name('admin.currency_conversion');
    Route::post('/update_currency_conversion',[HotelController::class, 'update_currency_conversion'])->name('admin.update_currency_conversion');
    Route::delete('/images/{id}', [ImageController::class, 'destroy'])->name('admin.delete_image');
    Route::get('/visa_charges', [VisaController::class, 'visa_charges'])->name('admin.visa_charges');
    Route::post('/update_visa_charges', [VisaController::class, 'update_visa_charges'])->name('admin.update_visa_charges');
});

Route::get('/home_page',[WebsiteController::class, 'homepage']);
// Route::get('/home_page', function(){
//     return view('website.home.index');    
// });

Route::get('/contact', function(){
    return view("website.contact.index");
});

Route::get('/about', function(){
    return view("website.about.index");
});

Route::get('/custom-package', [CostController::class,'calculate_package']);

Route::get('/all-hotels',[FrontHotelController::class, 'index']);
Route::get('/hotel/{id}',[FrontHotelController::class, 'singleHotel']);

Route::get('/test', function(){
    return view("admin.package.index");
});