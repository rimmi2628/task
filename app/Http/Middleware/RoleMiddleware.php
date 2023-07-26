<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        
        $user = auth()->user();
        
        if ($user->role == $role) {
            return $next($request);
        } else {
            // User does not have the required role, show an error message or redirect
            return response()->json(["msg"=>"You are not authorized"]);
        }
    }
}
