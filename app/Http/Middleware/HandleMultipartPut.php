<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleMultipartPut
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('put') && strpos($request->header('Content-Type'), 'multipart/form-data') !== false) {
            // Simulasikan metode PUT sebagai POST agar dapat membaca multipart form-data
            $request->merge(['_method' => 'PUT']);
            $request->setMethod('POST');
        }

        return $next($request);
    }
}


