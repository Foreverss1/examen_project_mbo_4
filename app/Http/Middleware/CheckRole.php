<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
   // checks if user is the rol dat is allowt
   if (!Auth::check() || !in_array(Auth::user()->role_id, $roles)) {
    abort(403, 'Unauthorized action.');
}

return $next($request);
    }
}
