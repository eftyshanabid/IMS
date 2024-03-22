<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!session()->has('languages')){
            session()->put('languages', \DB::table('language_libraries')->join('languages', 'languages.id', '=', 'language_libraries.language_id')->get(['language_libraries.slug', 'language_libraries.language_id', 'languages.code as language_code', 'language_libraries.translation']));
        }

        if(!session()->has('language-lists')){
            session()->put('language-lists', \DB::table('languages')->get());
        }

        return $next($request);
    }
}
