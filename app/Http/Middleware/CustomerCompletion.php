<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerCompletion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!isset(auth()->user()->businessInformation->id)){
            return redirect('guest/business-information');
        }

        if(auth()->user()->subscriptions->where('status', 'approved')->where('from', '<=', date('Y-m-d'))->where('to', '>=', date('Y-m-d'))->count() == 0){
            session()->flash('alert-type', 'error');
            session()->flash('message', 'Your membership has expired. Please renew your plan.');

            return redirect('guest/subscriptions');
        }

        return $next($request);
    }
}
