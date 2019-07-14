<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Overtrue\EasySms\EasySms;
use App\Http\Requests\Api\VerificationCodeRequest;

class VerificationCodesController extends Controller
{
    public function store(VerificationCodeRequest $request, EasySms $easySms)
    {
        // return $this->response->array(['test_message' => 'store verification code']);
        $phone = $request->phone;

        if (!app()->environment('production')) {
            $code = '1234';
        } else {
            //生成4位随机数，左侧补0
            $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);

            //用 easySms 发送短信到用户手机
            try {
                $result = $easySms->send($phone, [
                    'content'  =>  "{$code}为您的验证码。如非本人操作，请忽略本短信。"
                ]);
            } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
                $message = $exception->getException('qcloud')->getMessage();
                return $this->response->errorInternal($message ?: '短信发送异常');
            }
        }

        //发送成功后，生成一个 key，在缓存中存储这个 key 对应的手机以及验证码，10 分钟过期
        $key = 'verificationCode_'.str_random(15);
        $expiredAt = now()->addMinutes(10);
        //缓存验证码 10分钟过期。
        \Cache::put($key, ['phone' => $phone, 'code' => $code], $expiredAt);

        //将 key 以及 过期时间 返回给客户端
        return $this->response->array([
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
        ])->setStatusCode(201);
    }
}
