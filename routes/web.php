<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\WeekendController;
use App\Http\Controllers\RouteController;



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
    //Route::resource('roles', RoleController::class);
    //Route::resource('users', UserController::class);
    Route::resource('routes', RouteController::class);
    Route::resource('transports', TransportController::class);
    Route::resource('hotels', HotelController::class);
    Route::get('/get_hotels',[HotelController::class, 'get_hotels']);
    Route::get('/get_hotels',[HotelController::class, 'get_hotels']);
    Route::get('/get_tranports',[TransportController::class, 'get_transports']);
    Route::get('/get_routes',[RouteController::class, 'get_routes']);
    Route::get('/weekends', [WeekendController::class, 'index'])->name('weekends.index');
    Route::post('/weekends', [WeekendController::class, 'store'])->name('weekends.store');
    Route::get('/calculate_package',[HotelController::class, 'calculate_package'])->name('admin.calculate_package');
});


Route::get('/home_page', function(){
    return view('website.home.index');    
});

Route::get('/contact', function(){
    return view("website.contact.index");
});

Route::get('/about', function(){
    return view("website.about.index");
});
