<?php

use App\Http\Controllers\Web\AppealWebController;
use App\Http\Controllers\Web\NewsWebController;
use App\Http\Controllers\Web\PageWebController;
use Illuminate\Support\Facades\Route;


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

Route::get('/appeal', [AppealWebController::class, 'form'])->name('appeal.form');
Route::post('/appeal', [AppealWebController::class, 'send'])->name('appeal.send');

Route::get('/{slug}', PageWebController::class);

Route::get('/news/{slug}', NewsWebController::class);
