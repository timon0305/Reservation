<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoleMiddleware
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
        $actions = $request->route()->getAction();
        $roles = isset($actions['roles'])?$actions['roles']:null;
        if($this->checkRole($roles)||!$roles){
            return $next($request);
        }
        return redirect()->to('login');
    }
    private function checkRole($roles){
        foreach ($roles as $role){
            if(auth()->guard($role)->check()){
                return true;
            }
        }
        return false;
    }
}
