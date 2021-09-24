<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use App\Models\Gallery;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[UserController::class, 'register']);
Route::post('/login',[UserController::class, 'login']);
Route::post('/logout',[UserController::class, 'logout']);
Route::post('/refresh',[UserController::class, 'refreshToken']);
Route::get('/profile',[UserController::class, 'getMyProfile']);


Route::get('/galleries', [GalleryController::class, 'index']);
Route::get('/galleries/{gallery}', [GalleryController::class, 'show']);
Route::delete('/galleries/{gallery}', [GalleryController::class, 'destroy']);
Route::put('/galleries/{gallery}', [GalleryController::class, 'update']);
Route::post('/galleries/{gallery}/comments', [CommentController::class, 'store']);
Route::delete('/comments/{comment}', [CommentController::class, 'deleteComment']);

Route::post('/creategalleries', [GalleryController::class, 'store']);
Route::get('/my-galleries/{user_id}',[GalleryController::class,'getMyGalleries']);
