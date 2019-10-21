<?php

namespace App\Http\Middleware;

use Closure;

class cekuserlevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$user_level)
    {

        if (in_array(auth()->user()->id_user_level,$user_level)) {
            return $next($request);
        }else{
            return redirect('/');
        }
        
        
    }
}
