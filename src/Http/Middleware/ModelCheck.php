<?php

namespace Travierm\Http\Middleware;

use Closure;

class ModelCheck
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
        dd($request->modelName);

        abort(403, 'Access Denied');
    }
}
