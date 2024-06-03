<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommandController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/run-transport-validity', [CommandController::class, 'runTransportValidityCommand']);
Route::post('/run-hotel-validity-notifications', [CommandController::class, 'runHotelValidityNotificationsCommand']);
Route::post('/run-queue-work', [CommandController::class, 'runQueueWork']);
