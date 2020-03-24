<?php

use Illuminate\Http\Request;

Route::middleware('cors')->group(function () {

    Route::group(['prefix' => 'shop'], function () {

        //请求验证码
        Route::post('verificationCodes', 'ShopController@verificationCodes')->name('shop.verificationCodes');
        //注册
        Route::post('store', 'ShopController@store')->name('shop.store');
        //手机登陆
        Route::post('authorization-phone', 'ShopController@PhoneLogin')->name('phone.login');
        //账户登录
        Route::post('authorization', 'ShopController@Login')->name('name.login');



        Route::middleware('api.shop.auth')->group(function () {

            Route::post('show', 'ShopController@show')->name('shop.show');


            //添加商品分类
            Route::post('product/category', 'ProductCategoryController@store')->name('product.category');
            //分类列表
            Route::get('category/list', 'ProductCategoryController@CategoryList')->name('category.list');
            //修改分类
            Route::put('category/{product_category}/update', 'ProductCategoryController@update')->name('category.update');
            //删除分类
            Route::delete('category/{product_category}/delete', 'ProductCategoryController@delete')->name('category.delete');

            //商品列表
            Route::post('product/list', 'ProductController@index')->name('product.index');
            //商品下的卡密
            Route::post('card/list', 'ProductController@index')->name('product.index');

            //添加商品
            Route::post('product', 'ProductController@store')->name('product.store');
            //商品详情
            Route::get('product/{product}', 'ProductController@show')->name('product.show');
            //更新商品
            Route::put('product/{product}', 'ProductController@update')->name('product.update');

            //添加卡密
            Route::post('card', 'CardController@store')->name('card.store');
            //查看统计的卡密
            Route::post('product/list/card', 'CardController@ProductCard')->name('card.product_card');
            //删除卡密
            Route::delete('card', 'CardController@delete')->name('card.delete');
            //查看卡密
            Route::post('card/list', 'CardController@index')->name('card.index');
            //优惠券列表
            Route::post('coupon_code/list', 'CouponCodeController@index')->name('coupon_code.index');
            //添加优惠券
            Route::post('coupon_code', 'CouponCodeController@store')->name('coupon_code.store');
        });
    });

    //支付宝付款
    Route::get('payment/{order}/alipay', 'PaymentController@payByAlipay')->name('payment.alipay');
    //前端支付宝回调
    Route::get('payment/alipay/return', 'PaymentController@alipayReturn')->name('payment.alipay.return');
    //后端支付宝 支付回调
    Route::post('payment/alipay/notify', 'PaymentController@alipayNotify')->name('payment.alipay.notify');


    //查询订单
    Route::post('order/search', 'OrdersController@search')->name('order.search');
    //订单退款
    Route::patch('order/complaint', 'OrdersController@complaint')->name('order.complaint');
    //提交订单
    Route::post('order', 'OrdersController@store')->name('orders.store');
});
