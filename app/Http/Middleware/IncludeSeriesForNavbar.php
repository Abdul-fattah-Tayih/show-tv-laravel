<?php

namespace App\Http\Middleware;

use App\Series;
use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class IncludeSeriesForNavbar
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
        // Pass navbar shows to every request in the middleware group
        View::share('navbarSeries', Cache::remember('navbarSeries', 3600, function () {
            return Series::inRandomOrder()->limit(5)->get();
        }));
        return $next($request);
    }
}
