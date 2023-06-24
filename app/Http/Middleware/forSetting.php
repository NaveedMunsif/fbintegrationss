<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class forSetting
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
        if(Auth::user()->token){
            if(Auth::user()->facebook_page_id){
                return $next($request);
            }
            else{
                return redirect(route('setting'));
            }
        }
        else{
            return redirect(route('setting'));
        }

    }
};
