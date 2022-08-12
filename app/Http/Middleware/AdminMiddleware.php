<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user() && auth()->user()->accept)
            return $next($request);

        return redirect('/')->with("error", "승인된 사용자만 서비스를 이용할 수 있습니다. 로그인 후 이용 부탁드립니다.");
    }
}
