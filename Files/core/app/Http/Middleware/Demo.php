<?php

namespace App\Http\Middleware;

use Closure;

class Demo
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
        if ($request->isMethod('POST') || $request->isMethod('PUT') || $request->isMethod('DELETE')){
                if ($request->expectsJson()) {
                $response = [
                    'status'=>'error',
                    'message'=>'This is Demo version.  You can not change any thing'
                ];
                return response()->json($response);
            }
            $notification =  array('error' => 'This is Demo version.  You can not change any thing');
            return redirect()->back()->with($notification);
        }
        return $next($request);
    }
}
