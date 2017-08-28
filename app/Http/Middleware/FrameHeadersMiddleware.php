<?php

namespace App\Http\Middleware;

use Closure;

class FrameHeadersMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $response = $next($request);
        //  $response->header_remove('X-Frame-Options');
     $response->header('X-Frame-Options', 'ALLOW FROM 127.0.0.1 ');
     //$response->header('X-Frame-Options', 'DENY');
     return $response;

    }
}
