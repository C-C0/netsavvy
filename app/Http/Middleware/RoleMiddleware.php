<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // If not authenticated, redirect to login
            return redirect('/login');
        }
        
        // Get the authenticated user
        $user = Auth::user();

        // Check if user has any of the required roles
        if (!in_array($user->role, $roles)) {
            abort(403, 'Unauthorised action.');
        }

        // Redirect based on role
        if ($user->role === 'student') {
            // Redirect students back to the previous page or a specific page
            return redirect()->back()->with('error', 'You do not have access to this page.');
        }

        // If role is not recognised like guest, redirect back to home page
        return redirect()->route('home')->with('error', 'You do not have access to this page.');
    }
}
