<?php

use Illuminate\Http\Request;

Route::post('orders', 'OrdersController@store')->name('orders.store');
Route::get('alipay', function() {
    return app('alipay')->web([
        'out_trade_no' => time(),
        'total_amount' => '1',
        'subject' => 'test subject - 测试',
    ]);
});