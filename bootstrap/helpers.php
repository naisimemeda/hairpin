<?php
function ngrok_url($routeName, $parameters = [])
{
    // 开发环境，并且配置了 NGROK_URL
    if(app()->environment('local') && $url = config('app.zf_url')) {
        // route() 函数第三个参数代表是否绝对路径
        return $url.route($routeName, $parameters, false);
    }

    return route($routeName, $parameters);
}


function objToArr($obj)
{
    //先编码成json字符串，再解码成数组
    return json_decode(json_encode($obj), true);
}
