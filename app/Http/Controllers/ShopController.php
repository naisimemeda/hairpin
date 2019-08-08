<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopRequest;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Nice\XhySms\XhySms;

class ShopController extends Controller
{
    public function verificationCodes(Request $request, XhySms $xhySms){

        $request->validate([
            'phone' => [
                'required',
                'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/',
            ]
        ]);

        $phone = $request->phone;
        // 生成4位随机数，左侧补0
        $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);
        if (!app()->environment('production')) {
            $code = '1234';
        }else {
            try {
                $xhySms->send($phone,  [
                    'template' => 'SMS_163853034',
                    'data' => [
                        'code' => $code   //变量名
                    ]
                ], 'aliyun');
            } catch (\Exception $exception) {
                return $this->failed('短信发送异常', 401);
            }
        }

        $key = 'verificationCode_'.str_random(15);
        $expiredAt = now()->addMinutes(10);
        // 缓存验证码 10分钟过期。
        Cache::put($key, ['phone' => $phone, 'code' => $code], $expiredAt);
        return $this->setStatusCode(201)->success([
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
        ]);
    }

    public function store(ShopRequest $request){
        $verifyData = Cache::get($request->verification_key);

        if (!$verifyData) {
            return $this->failed('验证码已失效', 422);
        }
        if (!hash_equals($verifyData['code'], $request->verification_code)) {
            return $this->failed('验证码错误', 401);
        }

        $is_shop = Shop::query()->where('phone', $verifyData['phone'])->exists();

        if ($is_shop){
            return $this->failed('重复注册');
        }

        Shop::query()->create([
            'name' => $request->input('name'),
            'phone' => $verifyData['phone'],
            'password' => $request->input('password'),
        ]);

        // 清除验证码缓存
        Cache::forget($request->verification_key);

        return $this->setStatusCode(201)->success('成功');
    }

    public function PhoneLogin(Request $request){

        $request->validate([
            'phone' => [
                'required',
                'regex:/^((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8}$/',
            ]
        ]);

        $verifyData = Cache::get($request->verification_key);
        if (!$verifyData) {
            return $this->failed('验证码已失效', 422);
        }

        if (!hash_equals($verifyData['code'], $request->verification_code)) {
            // 返回401
            return $this->failed('验证码错误', 401);
        }

        $shop = Shop::where('phone', $verifyData['phone'])->first();


        // 清除验证码缓存
        Cache::forget($request->verification_key);

        $token = Auth::guard('shop')->login($shop);

        return $this->setStatusCode(201)->success([
            'token' => 'bearer ' . $token
        ]);
    }
}
