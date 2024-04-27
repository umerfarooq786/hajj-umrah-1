<?php

use App\Http\Controllers\MaktabController;
use Illuminate\Support\Facades\Auth;
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
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\PDFController;
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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', UserController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('check.permission:users-list');
    Route::get('/get_users', [UserController::class, 'get_users']);

    Route::resource('packages', PackageController::class);
    Route::get('/packages', [PackageController::class, 'index'])->name('packages.index')->middleware('check.permission:packages-list');
    Route::get('/get_packages', [PackageController::class, 'get_packages']);

    Route::resource('roles', RoleController::class);
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index')->middleware('check.permission:roles-list');

    Route::resource('testimonials', TestimonialController::class);
    Route::get('/get_testimonial_result', [TestimonialController::class, 'get_testimonial_result'])->name('get_testimonial_result');
    // Route::get('/roles', [RoleController::class , 'index'])->name('roles.index')->middleware('check.permission:roles-list');

    Route::resource('routes', RouteController::class);
    Route::get('/routes', [RouteController::class, 'index'])->name('routes.index')->middleware('check.permission:routes-list');
    Route::get('/get_routes', [RouteController::class, 'get_routes']);

    Route::resource('transports', TransportController::class);
    Route::get('/transports', [TransportController::class, 'index'])->name('transports.index')->middleware('check.permission:transports-list');
    Route::get('/get_tranports', [TransportController::class, 'get_transports']);
    Route::GET('/delete_transport_validity/{id}', [TransportController::class, 'delete_transport_validity'])->name('delete.transport_validity');

    Route::GET('/delete.validity/{date}', [HotelController::class, 'deleteValidity'])->name('delete.validity');
    Route::GET('/delete.offer/{id}', [HotelController::class, 'deleteOffer'])->name('delete.offer');
    Route::resource('hotels', HotelController::class);
    Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index')->middleware('check.permission:hotels-list');
    Route::get('/get_hotels', [HotelController::class, 'get_hotels']);

    Route::post('/weekends', [WeekendController::class, 'store'])->name('weekends.store');
    Route::get('/weekends', [WeekendController::class, 'index'])->name('weekends.index')->middleware('check.permission:add-weekends-days');

    Route::get('/custom_package', [HotelController::class, 'custom_package'])->name('admin.custom_package')->middleware('check.permission:packages-calculation');
    Route::post('/calculate_package', [HotelController::class, 'calculate_package'])->name('admin.calculate_package');

    Route::get('/currency_conversion', [HotelController::class, 'currency_conversion'])->name('admin.currency_conversion')->middleware('check.permission:currencys-conversion');
    Route::post('/update_currency_conversion', [HotelController::class, 'update_currency_conversion'])->name('admin.update_currency_conversion');

    Route::delete('/images/{id}', [ImageController::class, 'destroy'])->name('admin.delete_image');

    Route::get('/visa_charges', [VisaController::class, 'visa_charges'])->name('admin.visa_charges')->middleware('check.permission:visa-charges');
    Route::post('/update_visa_charges', [VisaController::class, 'update_visa_charges'])->name('admin.update_visa_charges');

    Route::resource('vehicles', VehicleController::class);
    // Route::get('/vehicles', [VehicleController::class, 'index'])->name('vehicles.index')->middleware('check.permission:vehicle-list');
    Route::get('/get_vehicles', [VehicleController::class, 'get_vehicles']);
    
    Route::resource('maktab', MaktabController::class);
    Route::get('/get_maktabs', [MaktabController::class, 'get_maktabs']);
});

// Contacts Routes
Route::resource('contacts', ContactsController::class);
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts.index')->middleware('check.permission:contacts-view');
Route::get('/get_contacts', [ContactsController::class, 'get_contacts']);


Route::get('/home_page', [WebsiteController::class, 'homepage'])->name('home_page');
// Route::get('/home_page', function(){
//     return view('website.home.index');    
// });
Route::get('/contact', [WebsiteController::class, 'contact']);
Route::get('/airlines', [WebsiteController::class, 'airlines']);

Route::get('/about', function () {
    return view("website.about.index");
});

Route::get('/custom-package', [CostController::class, 'calculate_package']);
Route::get('/custom-package-hajj', [CostController::class, 'calculate_package_hajj']);
Route::post('/calculate_package_result', [CostController::class, 'calculate'])->name('calculate.calculate_package_result');
Route::post('/get-hotel-rooms', [CostController::class, 'hotel_room_type'])->name('calculate.hotel_room_type');
Route::get('/get-hotel-note', [CostController::class, 'hotel_note'])->name('calculate.hotel_note');
Route::post('/get-hotel-meals', [CostController::class, 'hotel_meal_type'])->name('calculate.hotel_meal_type');
Route::get('/custom-package/result', [CostController::class, 'calculate_package_result']);
Route::get('/custom-package/result2', [CostController::class, 'calculate_package_result2']);

Route::get('/hotel-city/{city}', [FrontHotelController::class, 'index'])->name('hotels.city');
Route::get('/hotel-id/{id}', [FrontHotelController::class, 'singleHotel']);

Route::get('/predefined-package/umrah', [FrontHotelController::class, 'predefinedUmrah']);
Route::get('/predefined-package/hajj', [FrontHotelController::class, 'predefinedHajj']);

Route::get('/test', function () {
    return view("admin.package.index");
});

Route::post('/generate-pdf', [PDFController::class, 'generatePDF'])->name('download.pdf');
Route::get('/pdfpdf', function () {
    $data= [];
    return view("pdf.pdfDocument", ['data' => $data]);
});
