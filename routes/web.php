<?php

use Illuminate\Support\Facades\Route;

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

Route::post('/verify-pin', [App\Http\Controllers\API\PinController::class, 'verifyPin']);

Route::post('/save-picture', [App\Http\Controllers\API\PictureController::class, 'savePicture']);

Route::get('/pictures/{userId}', [App\Http\Controllers\API\PictureController::class, 'getByUserId']);

Route::get('/', function () {
    return view('welcome');
});