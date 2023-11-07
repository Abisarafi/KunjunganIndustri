<?php

namespace App\Exceptions;

use Exception;

class PageExpiredException extends Exception
{
    //
    public function render($request)
    {
        if ($request->is('api/*')) {
            return response(['error' => 'Page Expired'], 419);
        }

        return redirect()->guest(route('login'));
    }
}
