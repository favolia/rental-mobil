<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            // Prevent redirect loop for admin
            if ($role === 'admin' && !$request->routeIs('car.index')) {
                return redirect()->route('car.index');
            }

            // Prevent redirect loop for user
            if ($role === 'user' && !$request->routeIs('car.user')) {
                return redirect()->route('car.user');
            }
        }

        return $next($request);
    }
}
