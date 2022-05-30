<?php

use App\Http\Controllers\Web\AppealWebController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\NewsWebController;
use \App\Http\Controllers\PageWebController;
use \App\Http\Controllers\NewsWebController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/news/{slug}', NewsWebController::class);
Route::get('/{slug}', PageWebController::class);