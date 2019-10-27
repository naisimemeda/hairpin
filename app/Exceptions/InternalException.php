<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class InternalException extends Exception
{
    protected $msgForUser;

    public function __construct(string $message, string $msgForUser = '系统内部错误', int $code = 500)
    {
        parent::__construct($message, $code);
        $this->msgForUser = $msgForUser;
    }

    public function render(Request $request)
    {

        return response()->json(['code' => 422, 'status' => "error", 'message' => $this->msgForUser], $this->code);

    }
}
