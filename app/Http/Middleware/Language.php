<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use App;
class Language
{

    public function handle($request, Closure $next)
    {
        if(Cookie::has('locale')){
          $locale = Cookie::get('locale');
          App::setLocale($locale);
        }
          return $next($request);


    }
}
