<?php

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

// App routes
Route::group(['middleware' => ['auth:reseller', 'reseller.verified'], 'prefix' => 'reseller', 'as' => 'reseller.'], function () {
    Route::resource('payments', 'PaymentController')->only('index', 'store', 'edit', 'update');
    Route::get('profile', 'ResellerController@showProfile')->name('profile');
    Route::put('password/update', 'ResellerController@passwordUpdate')->name('profile.password.update');
    Route::put('email/update', 'ResellerController@emailUpdate')->name('email.update');
    Route::put('profile/update', 'ResellerController@profileUpdate')->name('profile.update');
    Route::resource('users', 'UserController')->only('index', 'store', 'edit', 'update');
    Route::put('users/{user}/password/update', 'UserController@passwordUpdate')->name('users.password.update');
    Route::get('users/export', 'UserController@export')->name('users.export');
    Route::post('users/export', 'UserController@exportUsers');
    Route::post('users/download/{exported_user}', 'UserController@downloadExportedUser')->name('users.exported_user.download');
    Route::patch('users/{user}/suspend', 'UserController@suspend')->name('users.suspend');
    Route::put('users/suspend-activate/all', 'UserController@suspendOrActicate')->name('users.suspend_or_activate');
    Route::get('users/{user}/services', 'UserController@services')->name('users.services');
    Route::delete('users/{user}/services', 'UserController@servicesDestroy')->name('users.services.destroy');
    Route::delete('users/{user}/services/{service}', 'UserController@serviceDestroy')->name('users.service.destroy');
    Route::post('users/{user}/services/custom-rate', 'UserController@serviceUpdate')->name('users.services.update');
    Route::post('users/services/update', 'UserController@serviceCustomRateUpdate')->name('users.services.rate.update');
    Route::put('users/services/bulkUpdate', 'UserController@serviceCustomRateBulkUpdate')->name('users.services.rate.update.bulk');
    Route::put('users/services/reset', 'UserController@serviceCustomRateReset')->name('users.services.rate.reset');

    /* atik code */
    Route::post('tickets/{ticket}/comment', 'TicketController@comment')->name('tickets.comment');
    Route::resource('tickets', 'TicketController');
    Route::delete('tickets/destroy', 'TicketController@destroy')->name('tickets.destroy');
    Route::put('tickets/close', 'TicketController@close')->name('tickets.close');
    /* end atik code */

    /* Route::put('tickets/update', 'TicketController@update')->name('tickets.update');
    Route::put('tickets/mark-as-unread', 'TicketController@markAsUnread')->name('tickets.mark.as.unread'); */
    Route::post('orders/update/{id}', 'OrderController@updateOrder')->name('order.reseller.update');
    Route::post('drip-feed/update/{id}', 'OrderController@updateDripOrder')->name('order.drip_feed.update');
    Route::get('drip-feed', 'OrderController@dripFeed')->name('order.drip_feed');
    Route::get('tasks', 'OrderController@refillOrders')->name('order.tasks');
    Route::resource('orders', 'OrderController')->only('index', 'update', 'destroy');
    Route::resource('appearance', 'CmsPageController');
    Route::post('appearance/status', 'CmsPageController@updateStatus')->name('appearance.updateStatus');
    Route::resource('menu', 'CmsMenuController');
    Route::post('menu/getMenuData', 'CmsMenuController@getMenuData')->name('menu.getMenuData');
    Route::post('menu/sortArrUpdate', 'CmsMenuController@sortArrUpdate')->name('menu.sortArrUpdate');
    Route::post('menu/delete', 'CmsMenuController@delete')->name('menu.delete');
    Route::resource('blog', 'CmsBlogController');
    Route::resource('blog-category', 'CmsBlogCategoryController');
    Route::resource('blog-slider', 'CmsBlogsliderController');
    Route::get('payments/export', 'PaymentController@export')->name('payments.export');
    Route::post('payments/export', 'PaymentController@exportPayment');
    Route::post('payments/download/{exported_payment}', 'PaymentController@downloadExportedPayment')->name('payments.exported_payment.download');
    Route::get('reports', 'ReportController@index')->name('reports.index');
    Route::get('reports/order', 'ReportController@order')->name('reports.order');
    Route::get('reports/ticket', 'ReportController@ticket')->name('reports.ticket');
    Route::get('reports/profits', 'ReportController@profits')->name('reports.profits');
    Route::get('enableCategory/{id}', 'CategoryController@enablingCategory')->name('category.status.change');
    Route::get('showCategory/{id}', 'CategoryController@displayCategory');
    Route::resource('categories', 'CategoryController');
    Route::post('category/sortData', 'CategoryController@sortData')->name('category.sort.data');
    Route::resource('services', 'ServiceController');
    Route::post('services/sortData', 'ServiceController@sortData')->name('service.sort.data');
    Route::get('showService/{id}', 'ServiceController@displayService')->name('service.api.get');
    Route::get('enableService/{id}', 'ServiceController@enableService')->name('service.change.status');
    Route::get('deleteService/{id}', 'ServiceController@deleteService')->name('service.delete');
    Route::post('service_bulk_category', 'ServiceController@bulkCategory');
    Route::post('service_bulk_enable', 'ServiceController@bulkEnable');
    Route::post('service_bulk_delete', 'ServiceController@bulkDelete');
    Route::post('service_bulk_disable', 'ServiceController@bulkDisable');
    Route::post('service_custom_rate_reset', 'ServiceController@resetManyServiceCustomRate')->name('service.custom.rate.reset.all');
    Route::get('resetCustomRate/{service_id}', 'ServiceController@resetUserServiceCustomRate')->name('service.custom.rate.reset');
    Route::get('duplicate/service/{service_id}', 'ServiceController@duplicateService')->name('service.duplicate');
    Route::post('updateService/{id}', 'ServiceController@updateService')->name('service.api.update');
    Route::post('provider/get/services', 'ServiceController@getProviderServices')->name('service.get.provider.data');
    Route::post('providers/{provider}/services', 'ServiceController@getProviderServicesByCategory')->name('provider.services');
    Route::post('providers/services/import', 'ServiceController@servicesImport')->name('provider.services.import');
    Route::resource('payments', 'PaymentController')->only('index', 'store', 'edit', 'update');
    Route::post('refill/order/status', 'OrderController@refillChnageStatus')->name('task.change.status');
    Route::resource('exported_orders', 'ExportedOrderController')->only('index', 'store');
    Route::post('exported_orders/{exported_order}/download', 'ExportedOrderController@download')->name('exported_orders.download');
});

// Auth routes
Route::group(['namespace' => 'Auth', 'prefix' => 'reseller', 'as' => 'reseller.'], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login')->name('login');
    Route::post('logout', 'LoginController@logout')->name('logout');
    Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'VerificationController@resend')->name('verification.resend');
    Route::get('password/confirm', 'ConfirmPasswordController@showConfirmForm')->name('password.confirm');
    Route::post('password/confirm', 'ConfirmPasswordController@confirm')->name('password.confirm');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('register', 'RegisterController@register')->name('register');
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
});

Route::group(['middleware' => ['auth:reseller', 'reseller.verified'], 'prefix' => 'reseller/setting', 'as' => 'reseller.setting.'], function () {
    Route::resource('general', 'CmsSettingGeneralController');
    Route::resource('module', 'CmsSettingModuleController');
    Route::post('module/getModuleData', 'CmsSettingModuleController@getModuleData')->name('module.getModuleData');
    Route::post('module/statusUpdate', 'CmsSettingModuleController@statusUpdate')->name('module.statusUpdate');
    Route::resource('notification', 'CmsSettingNotificationController');

    Route::resource('staff', 'CmsSettingStaffController');
    Route::PUT('staff/staffEmailUpdate/{id}', 'CmsSettingStaffController@staffEmailUpdate')->name('staff.emailUpdate');
    Route::post('staff/getStaffData', 'CmsSettingStaffController@getStaffData')->name('staff.getStaffData');
    Route::post('staff/delete', 'CmsSettingStaffController@delete')->name('staff.delete');

    Route::resource('bonuses', 'CmsSettingBonusesController');
    Route::post('bonuses/getBonusesData', 'CmsSettingBonusesController@getBonusesData')->name('bonuses.getBonusesData');
    Route::PUT('bonuses/updateData/{id}', 'CmsSettingBonusesController@updateData')->name('bonuses.updateData');

    Route::resource('faq', 'CmsSettingFaqController');
    Route::post('faq/sortArrUpdate', 'CmsSettingFaqController@sortArrUpdate')->name('faq.sortArrUpdate');

    Route::resource('payment', 'CmsSettingPaymentController');
    Route::post('payment/updateStatus', 'CmsSettingPaymentController@updateStatus')->name('payment.updateStatus');
    Route::post('payment/editPaymentMethod', 'CmsSettingPaymentController@editPaymentMethod')->name('payment.editPaymentMethod');
    Route::post('payment/updatePaymentMethod', 'CmsSettingPaymentController@updatePaymentMethod')->name('payment.updatePaymentMethod');
    Route::post('payment/sortArrUpdate', 'CmsSettingPaymentController@sortArrUpdate')->name('payment.sortArrUpdate');

    Route::resource('provider', 'CmsSettingProviderController');
    Route::post('provider/editProvider', 'CmsSettingProviderController@editProvider')->name('provider.editProvider');
    Route::put('provider/updateProvider', 'CmsSettingProviderController@update')->name('provider.updateProvider');
    Route::delete('provider/delProvider', 'CmsSettingProviderController@destroy')->name('provider.delProvider');
});
