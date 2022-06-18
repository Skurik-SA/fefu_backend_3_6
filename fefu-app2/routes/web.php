<?php

use App\Http\Controllers\Web\AppealWebController;
use App\Http\Controllers\Web\AuthWebController;
use App\Http\Controllers\Web\CatalogController;
use App\Http\Controllers\Web\NewsWebController;
use App\Http\Controllers\Web\OAuthController;
use App\Http\Controllers\Web\PageWebController;
use App\Http\Controllers\Web\ProfileController;
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

Route::get('catalog/{slug?}', [CatalogController::class, 'index'])->name('catalog');

Route::prefix('oauth')->group(function () {
    Route::get('/{provider}/redirect', [OAuthController::class, 'redirectToService'])->name('oauth.redirect');
    Route::get('/{provider}/login', [OAuthController::class, 'login'])->name('oauth.login');
});

Route::get('/profile', [ProfileController::class, 'show'])->name('profile')->middleware('auth');

Route::get('/login', [AuthWebController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthWebController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthWebController::class, 'logout'])->name('logout');

Route::get('/registration', [AuthWebController::class, 'registrationForm'])->name('registration');
Route::post('/registration', [AuthWebController::class, 'registration'])->name('registration.post');

Route::get('/appeal', [AppealWebController::class, 'form'])->name('appeal.form');
Route::post('/appeal', [AppealWebController::class, 'send'])->name('appeal.send');

Route::get('/{slug}', PageWebController::class);

Route::get('/news/{slug}', NewsWebController::class);


