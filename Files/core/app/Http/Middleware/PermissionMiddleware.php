<?php

namespace App\Http\Middleware;

use Closure;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$permission='admin')
    {

        $eccept_role = [0=>'admin',1=>'staff'];
        $arr = explode('|',$permission);
        $role = $eccept_role[$request->user()->role];//1

        if(in_array($role,$arr)){
            return $next($request);
        }
        abort(401);


    }
}
