<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ServiceController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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

Route::get('/logout', [LoginController::class, 'logout'])->name('logout.get');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth', 'verified'])->group(function () {

    Route::prefix('organizations/{organization}') -> name('organizations.') -> controller(OrganizationController::class) -> group(function (){
        Route::post('name/update', 'updateName') -> name('name.update');
        Route::post('description/update', 'updateDescription') -> name('description.update');
    });
    Route::resource('organizations', OrganizationController::class)->only(['create', 'store', 'show']);


    Route::post('service/like-dislike', [ServiceController::class, 'serviceLikeUnlike']) -> name('services.like-dislike');
    Route::prefix('services/{service}')->name('services.')->controller(ServiceController::class)->group(function () {
        Route::post('new_image', 'changeImage')->name('image.change');
        Route::post('name/update', 'updateName')->name('name.update');
        Route::post('description/update', 'updateDescription')->name('description.update');
        Route::post('price/update', 'updatePrice')->name('price.update');
        Route::post('price-type/update', 'updatePriceType')->name('price.type.update');
        Route::post('service-category/update', 'updateServiceCategory')->name('service.category.update');
        Route::post('area/update', 'updateArea')->name('area.update');
    });
    Route::resource('services', ServiceController::class)->except(['update', 'edit']);


    Route::prefix('members/{member}') -> name('members.') -> controller(MemberController::class)->group(function (){
        Route::post('name/update', 'updateName') -> name('name.update');
        Route::post('phone/update', 'updatePhone') -> name('phone.update');
        Route::post('address/update', 'updateAddress') -> name('address.update');
        Route::post('area/update', 'updateArea') -> name('area.update');
        Route::post('state/update', 'updateUserState') -> name('state.update');
        Route::post('promote', 'promoteMember') -> name('promote');
        Route::post('demote', 'demoteMember') -> name('demote');
    });
    Route::resource('members', MemberController::class)->except(['update', 'edit']);


});

Route::get('search', [SearchController::class, 'index']) -> name('search');




/**
 * ----------------------------------
 * Routes for email verification
 * ----------------------------------
 */
Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
