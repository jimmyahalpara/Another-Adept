<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Route::get('/logout', [LoginController::class, 'logout']) -> name('logout.get');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth') -> group(function (){
    Route::resource('organizations',OrganizationController::class) -> only(['create', 'store']);

    Route::post('services/{service}/new_image', [ServiceController::class, 'changeImage']) -> name('services.image.change');
    Route::resource('services', ServiceController::class);
});







