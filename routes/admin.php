<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::controller(AdminController::class)->group(function(){
  Route::group(['middleware' => ['can:administrador']], function(){
        Route::get('userscontrol', 'userscontrol')->name('userscontrol');
        Route::get('createAdminUser', 'createAdminUser')->name('createAdminUser');
        Route::get('createCashierUser', 'createCashierUser')->name('createCashierUser');
        Route::get('categories', 'categories')->name('categories');
        Route::get('providers', 'providers')->name('providers');
        Route::get('orders', 'orders')->name('orders');
        Route::get('activity_log', 'activity_log')->name('activity_log');
        Route::get('ordersDone', 'ordersDone')->name('ordersDone');
        Route::get('detailOrders/{id}', 'detailOrders')->name('detailOrders');
        Route::get('setting', 'setting')->name('setting');
        Route::get('client', 'client')->name('client');
        Route::get('sessonHistory', 'sessonHistory')->name('sessonHistory');
        Route::get('salesDone', 'salesDone')->name('salesDone');
        Route::get('detailItemSale/{id}', 'detailItemSale')->name('detailItems');
        Route::get('reprint/{sale}', 'reprint')->name('reprint');
        Route::get('categoryExport', 'categoryExport')->name('categoryExport');
        Route::get('voucherHistory', 'voucherHistory')->name('voucherHistory');
        Route::get('incomesOutcomes', 'incomesOutcomes')->name('incomesOutcomes');
  });
});
