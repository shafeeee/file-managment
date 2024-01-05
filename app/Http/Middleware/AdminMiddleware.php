<?php

// app/Http/Middleware/AdminMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if ($request->user() && $request->user()->user_role == $role) {
            
            return $next($request);
        }

        abort(403, 'Unauthorized action.');
    }
}
