<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;


class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        $language = 'en';
//
//        config(['app.locale' => $language]);
//        \App::setLocale($language);

        return $next($request);
    }
}
