<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle($request, Closure $next, $permission)
    {
        // if (!Auth::user()->can($permission)) {
        //     abort(403, 'Unauthorized action.');
        // }

        return $next($request);
    }
}

