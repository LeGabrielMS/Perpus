<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // First check if the user is logged in
        if (!Auth::check()) {
            // If not logged in, redirect to home page
            return redirect('/');
        }

        // Then check if the user is an admin
        if (Auth::user()->usertype != 'admin') {
            // If not an admin, redirect to home page
            return redirect('/')->with('error', 'You do not have admin access.');
        }

        // Allow the request to proceed if user is logged in and is an admin
        return $next($request);
    }
}
