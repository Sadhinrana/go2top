<?php

use App\CmsMenu;

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
    return view('home');
});
//Route::get('/', 'HomeController@homePage');

Auth::routes(['verify' => true]);

//order routes


/* Route::resource('tickets', 'TicketController'); */
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('profile', 'UserController@showProfile')->name('profile');
    Route::put('password/update', 'UserController@passwordUpdate')->name('profile.password.update');
    Route::put('email/update', 'UserController@emailUpdate')->name('email.update');
    Route::put('profile/update', 'UserController@profileUpdate')->name('profile.update');

    Route::get('new_order', 'HomeController@index')->name('single-order');
    Route::get('service', 'Fronend\FrontendController@showServicefrontEnd');
    Route::get('s-service', 'Fronend\FrontendController@showServicefrontEnd');
    Route::get('mass_order', 'HomeController@massOrder')->name('mass-order');
    Route::post('make_new_order','Reseller\OrderController@store');
    Route::post('make_mass_order','Reseller\OrderController@storeMassOrder')->name('massOrder.store');
    Route::get('orders','Reseller\OrderController@orderLists')->name('orderHistories');
    Route::post('statusChanges','Reseller\OrderController@refillStatusChange')->name('user.changeRefillStatus');

    Route::get('/add-funds', 'Fronend\PaymentMethod@index')->name('reseller.front.payment.add');
    Route::get('/payment/add-funds/paypal', 'Fronend\PaypalController@showForm');
    Route::post('/payment/add-funds/paypal', 'Fronend\PaypalController@store');
    Route::get('/payment/add-funds/paypal/success', 'Fronend\PaypalController@success');
    Route::get('/payment/add-funds/paypal/cancel', 'Fronend\PaypalController@cancel');
    Route::post('/payment/add-funds/payOp', 'Fronend\PayOpController@store')->name('payment.payOp');
    Route::post('/payment/add-funds/bitcoin/bit-ipn', 'Fronend\CoinPaymentsController@ipn');
    Route::get('/payment/add-funds/bitcoin', 'Fronend\CoinPaymentsController@showForm');
    Route::post('/payment/add-funds/bitcoin', 'Fronend\CoinPaymentsController@store');
    Route::get('/payment/add-funds/bitcoin/cancel', 'Fronend\CoinPaymentsController@cancel');
    Route::get('/payment/add-funds/bitcoin/success', 'Fronend\CoinPaymentsController@success');

    Route::post('supportTickets/comments/store', 'Fronend\SupportTicketController@makeComment')->name('ticket.comment.store');
    Route::resource('supportTickets', 'Fronend\SupportTicketController');

    Route::get('account', 'Fronend\FrontendController@getAccount');
});

/* CmsMenu::select('cms_menus.*', 'cms_pages.url as route_link', 'cms_pages.content as content')
    ->join('cms_pages', 'cms_pages.id', '=', 'cms_menus.menu_link_id')
    ->where('cms_menus.menu_link_type','yes')
    ->where('cms_pages.non_editable', false)->get()
    ->map(function ($q){
        $contents = $q->content;
       Route::get($q->route_link, function() use($contents){
           return view('frontend.cms-pages', compact('contents'));
       });
}); */



Route::get('/payment/add-funds/stripe', 'Fronend\StripeController@showForm');
Route::post('/payment/add-funds/stripe', 'Fronend\StripeController@store');
Route::get('/blog', 'Fronend\BlogController@index');
Route::get('/blog/post', 'Fronend\BlogController@blogpost');
Route::get('/blog/post/{slug}', 'Fronend\BlogController@post');
Route::get('faq', 'Reseller\CmsSettingFaqController@getFrontEndView');
Route::get('about-us', 'Reseller\CmsSettingFaqController@getPublicAboutUs');
Route::get('/thank-you', 'Fronend\FrontendController@thanks');

