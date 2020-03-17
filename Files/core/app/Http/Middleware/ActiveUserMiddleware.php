<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class ActiveUserMiddleware
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
        if(Auth::check() && !Auth::user()->status) {
            return redirect()->route('home')->with('error','Your account has been blocked');
        }
        return $next($request);
    }
}
