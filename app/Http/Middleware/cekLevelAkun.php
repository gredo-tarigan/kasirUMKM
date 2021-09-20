<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class cekLevelAkun
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$levels)
    {
        if(in_array($request->user()->tipe,$levels)){
            return $next($request);
        }

        return redirect('/');
    }
}
