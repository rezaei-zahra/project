<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DayOfWeekController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\ListSickController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/search/{name?}/{city?}/{specialty?}', [UserController::class, 'search']);
Route::get('/listAllDoctor', [UserController::class, 'listAllDoctor']);


Route::middleware(['auth:api'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/visitRequest/{id}', [ListSickController::class, 'visitRequest']);
    Route::post('/createFavourite/{id}', [FavouriteController::class, 'createFavourite']);
    Route::post('/deleteFavourite/{id}', [FavouriteController::class, 'deleteFavourite']);
    Route::get('/showFavourites', [FavouriteController::class, 'showFavourites']);




    //روتهای مربوط به پزشک
    Route::post('/changeInfoDoctor', [UserController::class, 'changeInfoDoctor']);
    Route::post('/changeWorkDay', [DayOfWeekController::class, 'changeWorkDay']);
    Route::get('/ShowListSicks', [ListSickController::class, 'ShowListSicks']);
});
