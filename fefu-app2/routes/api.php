<?php

use App\Http\Controllers\Api\AppealApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\CatalogApiController;
use App\Http\Controllers\Api\NewsApiController;
use App\Http\Controllers\Api\PageApiController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthApiController::class, 'user']);
    Route::post('logout', [AuthApiController::class,'logout']);
});

Route::apiResource('news', NewsApiController::class)->only([
    'index',
    'show',
]);

Route::apiResource('page', PageApiController::class)->only([
    'index',
    'show',
]);

Route::apiResource('appeal', AppealApiController::class)->only([
    'store',
]);

Route::apiResource('categories', CatalogApiController::class)->only([
    'index',
    'show',
]);

Route::post('login', [AuthApiController::class, 'login']);
Route::post('registration', [AuthApiController::class, 'registration']);
