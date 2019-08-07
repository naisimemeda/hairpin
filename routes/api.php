<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'shop'], function () {
    //请求验证码
    Route::post('verificationCodes', 'ShopController@verificationCodes')->name('shop.verificationCodes');
    //注册
    Route::post('store', 'ShopController@store')->name('shop.store');
    //登陆
    Route::post('authorization', 'ShopController@PhoneLogin')->name('phone.login');
    Route::post('phone', 'ShopController@info')->name('shop.info');


    //添加商品
    Route::post('product', 'ProductController@store')->name('product.store');
});

Route::post('orders', 'OrdersController@store')->name('orders.store');
Route::get('alipay', function() {
    return app('alipay')->web([
        'out_trade_no' => time(),
        'total_amount' => '1',
        'subject' => 'test subject - 测试',
    ]);
});