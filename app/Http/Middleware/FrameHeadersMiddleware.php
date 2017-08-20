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
    //  $response->header->remove('X-Frame-Options');
     $response->header('X-Frame-Options', 'ALLOW FROM http://198.199.122.78.com/',false);
     return $response;

    }
}
