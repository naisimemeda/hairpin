<?php

use Illuminate\Http\Request;

Route::middleware('cors')->group(function () {
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
        //商品详情
        Route::get('product/{product}', 'ProductController@show')->name('product.show');
        //更新商品
        Route::put('product/{product}', 'ProductController@update')->name('product.update');

        //添加卡密
        Route::post('card', 'CardController@store')->name('card.store');
        //查看sku列表统计的卡密
        Route::get('sku_card', 'CardController@SkuCard')->name('card.sku_card');
        //删除卡密
        Route::delete('card', 'CardController@delete')->name('card.delete');
        //查看卡密
        Route::get('card', 'CardController@index')->name('card.index');
    });
    Route::get('payment/{order}/alipay', 'PaymentController@payByAlipay')->name('payment.alipay');
    //前端支付宝回调
    Route::get('payment/alipay/return', 'PaymentController@alipayReturn')->name('payment.alipay.return');
    //后端支付宝 支付回调
    Route::post('payment/alipay/notify', 'PaymentController@alipayNotify')->name('payment.alipay.notify');

    Route::post('orders', 'OrdersController@store')->name('orders.store');
});