<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class CustomModelNotFound extends ModelNotFoundException
{
    protected $message;
    protected $code = 404;

    public function __construct($message, $code)
    {
        $this->message = $message;
        $this->code = $code;
    }
}
