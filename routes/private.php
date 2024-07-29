<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DailyProcessController;

Route::controller(DailyProcessController::class)->group(function(){
  Route::group(['middleware' => ['can:procesos.diarios']], function(){
    Route::get('products', 'products')->name('products');
    Route::get('outcomes', 'outcomes')->name('outcomes');
    Route::get('reports', 'reports')->name('reports');
    Route::get('exchange-rate', 'exchangeRate')->name('exchangeRate');
    Route::get('sales', 'sales')->name('sales');
    Route::get('exportProduct', 'exportProduct')->name('exportProduct');
  });
});
