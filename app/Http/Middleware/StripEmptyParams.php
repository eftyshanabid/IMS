<?php

namespace App\Http\Middleware;

use Closure;

class StripEmptyParams
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $query = request()->query();
        $queryCount = count($query);
        foreach ($query as $key => $value) {
            if ($value == '') {
                unset($query[$key]);
            }
        }
        if ($queryCount > count($query)) {
            $path = url()->current() . (!empty($query) ? '/?' . http_build_query($query) : '');
            return redirect()->to($path);
        }
        return $next($request);
    }
}
