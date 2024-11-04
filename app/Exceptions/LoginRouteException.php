<?php

// app/Exceptions/LoginRouteException.php
namespace App\Exceptions;

use Exception;

class LoginRouteException extends Exception
{
    public function render()
    {
        return response()->view('errors.500', [], 500);
    }
}
