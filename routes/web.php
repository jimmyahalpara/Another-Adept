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


    Route::prefix('services/{service}') -> name('services.') -> controller(ServiceController::class) -> group(function (){
        Route::post('new_image', 'changeImage') -> name('image.change');
        Route::post('name/update', 'updateName') -> name('name.update');
        Route::post('description/update', 'updateDescription') -> name('description.update');
        Route::post('price/update', 'updatePrice') -> name('price.update');
        Route::post('price-type/update', 'updatePriceType') -> name('price.type.update');
        Route::post('service-category/update', 'updateServiceCategory') -> name('service.category.update');
        Route::post('area/update', 'updateArea') -> name('area.update');
    });

    Route::resource('services', ServiceController::class) -> except(['update', 'edit']);
});







