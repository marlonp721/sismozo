<?php

namespace App\Http\Middleware;

use Closure;

class JsonRequest
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
        if ( $request->wantsJson() ) :

            return $next($request);

        endif;

        abort(405, 'Must request a JSON');
    }
}
