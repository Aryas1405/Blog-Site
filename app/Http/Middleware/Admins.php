<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;


use Closure;

class Admins
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
        {
            if(Auth::user()->type == 'admin'){
                redirect()->route('categories.index');
                return $next($request);
            } else {
                abort(404);
            }
        }
    }
}
