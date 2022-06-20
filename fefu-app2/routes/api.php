<?php

use App\Http\Controllers\Api\AppealApiController;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CatalogApiController;
use App\Http\Controllers\Api\NewsApiController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PageApiController;
use App\Http\Controllers\Api\ProductApiController;
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

Route::prefix('catalog')->group(function () {
    Route::get('product/list', [ProductApiController::class, 'index']);
    Route::get('product/details', [ProductApiController::class, 'show']);
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

Route::prefix('cart')->middleware('auth.optional:sanctum')->group(function () {
    Route::post('set_quantity', [CartController::class, 'set_quantity']);
    Route::get('show', [CartController::class, 'show']);
});

Route::apiResource('catalog', CatalogApiController::class)->only([
    'index',
    'show',
]);

Route::post('/order/store', [ OrderController::class, 'store']);

Route::post('login', [AuthApiController::class, 'login']);
Route::post('registration', [AuthApiController::class, 'registration']);
