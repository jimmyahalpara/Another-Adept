<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PaytmController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserRatingController;
use App\Http\Middleware\VerifyCsrfToken;
use App\Jobs\NewOrganizationRequestJob;
use App\Jobs\NewOrganizationRequestRejectJob;
use App\Jobs\OrderAssignJob;
use App\Jobs\OrderPlacedAdminJob;
use App\Jobs\OrderPlacedJob;
use App\Jobs\WelcomeMailJob;
use App\Mail\WelcomeMail;
use App\Models\Organization;
use App\Models\ServiceOrder;
use App\Models\User;
use Faker\Guesser\Name;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

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

    Route::prefix('organizations/{organization}')->name('organizations.')->controller(OrganizationController::class)->group(function () {
        Route::post('name/update', 'updateName')->name('name.update');
        Route::post('description/update', 'updateDescription')->name('description.update');
        Route::post('payment/update', 'update_organization_payment_information')->name('payment.update');
        Route::post('payout/request', 'request_payout')->name('payout.request');

        Route::get('active/confirmation', 'active_confirmation_form')->name('active.confirmation');
        Route::post('active/confirmation', 'active_confirmation')->name('active.confirmation.post');
    });
    
    Route::get('organizations/payout/{payout}/confirmation',[OrganizationController::class, 'payout_form'])->name('organizations.payout.confirmation');
    Route::post('organizations/payout/{payout}/confirmation',[OrganizationController::class, 'payout_confirm'])->name('organizations.payout.confirmation.post');
    
    Route::resource('organizations', OrganizationController::class)->only(['create', 'store', 'show']);


    Route::post('service/like-dislike', [ServiceController::class, 'serviceLikeUnlike'])->name('services.like-dislike');
    Route::prefix('services/{service}')->name('services.')->controller(ServiceController::class)->group(function () {
        Route::post('new_image', 'changeImage')->name('image.change');
        Route::post('name/update', 'updateName')->name('name.update');
        Route::post('description/update', 'updateDescription')->name('description.update');
        Route::post('price/update', 'updatePrice')->name('price.update');
        Route::post('price-type/update', 'updatePriceType')->name('price.type.update');
        Route::post('service-category/update', 'updateServiceCategory')->name('service.category.update');
        Route::post('area/update', 'updateArea')->name('area.update');
        Route::post('rate', 'rate')->name('rate');
    });
    Route::resource('services', ServiceController::class)->except(['update', 'edit']);


    Route::prefix('members/{member}')->name('members.')->controller(MemberController::class)->group(function () {
        Route::post('name/update', 'updateName')->name('name.update');
        Route::post('phone/update', 'updatePhone')->name('phone.update');
        Route::post('address/update', 'updateAddress')->name('address.update');
        Route::post('area/update', 'updateArea')->name('area.update');
        Route::post('state/update', 'updateUserState')->name('state.update');
        Route::post('promote', 'promoteMember')->name('promote');
        Route::post('demote', 'demoteMember')->name('demote');
    });
    Route::resource('members', MemberController::class)->except(['update', 'edit']);



    Route::prefix('home')->name('home.')->controller(HomeController::class)->group(function () {
        Route::get('liked-posts', 'view_liked')->name('cart');
        Route::get('orders', 'my_orders')->name('orders');
        Route::post('cancel', 'cancel_order')->name('cancel');
        Route::get('profile', 'view_profile')->name('profile')->withoutMiddleware('verified');
        Route::post('profile', 'edit_profile')->name('profile')->withoutMiddleware('verified');
    });


    Route::prefix('order')->name('order.')->controller(OrderController::class)->group(function () {
        Route::get('{service}/place-order', 'order')->name('place');
        Route::post('{service}/place-order', 'order_confirm')->name('confirm');
        Route::get('organization', 'view_organization_orders')->name('organization');
        Route::get('organization/detail', 'view_order_detail_ajax')->name('details');
        Route::post('assign', 'assign')->name('assign');
        Route::post('cancel', 'cancel_order')->name('cancel');
        Route::post('reject', 'reject_order')->name('reject');
        Route::get('my-orders', 'my_orders')->name('my.orders');
        Route::post('assigned/change-state', 'change_order_member_state')->name('assigned.state.change');
        Route::post('complete', 'complete')->name('complete');
        Route::get('{service_order}/invoice/create', 'generate_invoice_form')->name('invoice.create');
        Route::post('{service_order}/invoice/store', 'store_invoice')->name('invoice.store');
    });

    Route::prefix('invoice')->name('invoice.')->controller(InvoiceController::class)->group(function () {
        // route to delete invoice 
        Route::post('delete', 'delete')->name('delete');
        // route to index 
        Route::get('index', 'index')->name('index');
        Route::get('{invoice}/pdf', 'generate_pdf')->name('pdf');
        Route::get('{invoice}/pdf/view', 'view_pdf_admin')->name('pdf.view');
    });



    Route::post('{invoice}/payment', [PaytmController::class, 'pay'])->name('make.payment')->withoutMiddleware([VerifyCsrfToken::class]);

    Route::get('private_documents/{filename}', [App\Http\Controllers\StorageController::class, 'getDocument'])->name('storage.get.document');
});

// paytm clalback uri
Route::post('paytm/callback', [PaytmController::class, 'paymentCallback'])->name('paytm.callback')->withoutMiddleware([VerifyCsrfToken::class]);
Route::get('search', [SearchController::class, 'index'])->name('search');
Route::get('search/{service}', [SearchController::class, 'show'])->name('search.show');


Route::get('service-rating/', [UserRatingController::class, 'index'])->name('service.rating');


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



Route::view('trial', 'invoice.viewpdf');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


// Route::get('/mailtest', function () {
//     return view('mails.welcome');
// });

Route::get('/sendMail', function(){
    $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
	$beautymail->send('mails.order_assigned', ['order' => ServiceOrder::find(3), 'member' => User::find(1)], function($message)
	{
		$message
			->from('noreply.serviceadept.me@gmail.com', 'Service Adept Help Desk')
			->to('jimmyahalpara123@gmail.com', 'Jimmy Ahalpara')
			->subject('New Order');
	});
});

Route::get('/jobtest', function () {
    $job = new OrderAssignJob(['order' => ServiceOrder::find(3), 'user' => User::find(1)]);
    dispatch($job);
});

