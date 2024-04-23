<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Http\Request;

class Timezone extends Middleware
{
    public function handle($request, Closure $next, $guard = null)
    {
        date_default_timezone_set("Asia/Dhaka");

        return $next($request);
    }
}
