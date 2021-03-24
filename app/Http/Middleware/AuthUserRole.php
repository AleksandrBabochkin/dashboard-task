<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthUserRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        $roles = explode('|', $role);
        if (in_array(User::$roles[Auth::user()->role], $roles, true)) {
            return $next($request);
        }
        return abort(403);
    }
}
