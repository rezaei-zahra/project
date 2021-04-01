<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
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
Route::get('/search', [UserController::class, 'search']);
Route::get('/listAllDoctor', [UserController::class, 'listAllDoctor']);


Route::middleware(['auth:api'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);

    //روتهای مربوط به کاربر
    Route::post('/visitRequest/{id}', [ListSickController::class, 'visitRequest']);
    Route::post('/createFavourite/{id}', [FavouriteController::class, 'createFavourite']);
    Route::delete('/deleteFavourite/{id}', [FavouriteController::class, 'deleteFavourite']);
    Route::get('/showFavourites', [FavouriteController::class, 'showFavourites']);
    Route::post('/createComment', [CommentController::class, 'createComment']);
    Route::delete('/deleteComment/{id}', [CommentController::class, 'deleteComment']);
    Route::post('/changeInfoSick', [UserController::class, 'changeInfoSick']);


    //روتهای مربوط به پزشک
    Route::get('/ShowListSicks', [ListSickController::class, 'ShowListSicks']);
    Route::post('/changeInfoDoctor', [UserController::class, 'changeInfoDoctor']);
    Route::post('/changeWorkDay', [DayOfWeekController::class, 'changeWorkDay']);
    Route::get('/showCommentDoctor', [CommentController::class, 'showCommentDoctor']);

});
