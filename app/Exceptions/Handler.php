<?php

namespace App\Exceptions;

use App\Common\Toast;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        InvalidRequestException::class,
        CouponCodeUnavailableException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     *  Report or log an exception
     * @param Exception $exception
     * @return mixed|void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {

        if($exception instanceof NotFoundHttpException){
            return response()->json(['code' => 404, 'status' => "error", 'message' => '没有找到该页面'], 404);

        }

        if($exception instanceof UnauthorizedHttpException){
            dd($exception);
            return response()->json(['message' => '未登录或登录状态失效'], 403);
        }

        if ($exception instanceof ValidationException) {
            // 只读取错误中的第一个错误信息
            $errors  = $exception->errors();
            $message = '';
            // 框架返回的是二维数组，因此需要去循环读取第一个数据
            foreach ($errors as $key => $val) {
                $keys    = array_key_first($val);
                $message = $val[$keys];
                break;
            }
            return response()->json(['code' => 422, 'status' => "error", 'message' => $message], 422);
        }

        if ($exception instanceof AuthorizationException) {
            return response()->json(['message' => '没有该权限'], 403);
        }

        if ($exception instanceof ModelNotFoundException) {
            return response()->json(['message' => '不要搞事情哦'], 403);
        }

        return parent::render($request, $exception);
    }

    protected function whoopsHandler()
    {
        try {
            return app(\Whoops\Handler\HandlerInterface::class);
        } catch (\Illuminate\Contracts\Container\BindingResolutionException $e) {
            return parent::whoopsHandler();
        }
    }
}
