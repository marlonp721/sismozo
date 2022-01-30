<?php

namespace App\Http\Middleware;

use Illuminate\Http\JsonResponse;
use Closure;

class RoleSuperuser
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
        $params = $request->route()->parameters();

        if ( $params )
        {
            $role = $params['role'];
            
            if ( ! $role->isSuperuser() )
            {
                return $next($request);
            }

            return new JsonResponse('El perfil Super Usuario no puede alterarse.', 422);
        }

        abort(403);
    }

}