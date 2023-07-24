<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Rutele pentru autentificare
Route::post('/login', [App\Http\Controllers\API\UserController::class, 'login']);
Route::post('/register', [App\Http\Controllers\API\UserController::class, 'register']);


// Rutele pentru fotografii
Route::get('/pictures', [App\Http\Controllers\API\PictureController::class, 'getAll']);
Route::get('/picture/{pictureId}', [App\Http\Controllers\API\PictureController::class, 'getById']);
Route::post('/picture', [App\Http\Controllers\API\PictureController::class, 'addPicture']);
Route::post('/picture/{pictureId}', [App\Http\Controllers\API\PictureController::class, 'editPicture']);
Route::delete('/picture/{pictureId}', [App\Http\Controllers\API\PictureController::class, 'deletePicture']);


// Rutele pentru pin-uri
Route::get('/pins', [App\Http\Controllers\API\PinController::class, 'getAll']);
Route::get('/pin/{pinId}', [App\Http\Controllers\API\PinController::class, 'getById']);
Route::post('/pin', [App\Http\Controllers\API\PinController::class, 'addPin']);
Route::post('/pin/{pinId}', [App\Http\Controllers\API\PinController::class, 'editPin']);
Route::delete('/pin/{pinId}', [App\Http\Controllers\API\PinController::class, 'deletePin']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});