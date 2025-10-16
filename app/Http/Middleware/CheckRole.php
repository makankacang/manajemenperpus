<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        \Log::info('CheckRole Middleware Called', [
            'user' => $request->user() ? $request->user()->email : 'No user',
            'user_role' => $request->user() && $request->user()->role ? $request->user()->role->nama : 'No role',
            'required_roles' => $roles
        ]);

        if (!$request->user()) {
            \Log::warning('No authenticated user');
            abort(403, 'Unauthorized - Please login first');
        }

        if (!$request->user()->role) {
            \Log::warning('User has no role assigned', ['user_id' => $request->user()->id]);
            abort(403, 'Unauthorized - No role assigned to user');
        }

        if (!in_array($request->user()->role->nama, $roles)) {
            \Log::warning('User role not allowed', [
                'user_role' => $request->user()->role->nama,
                'allowed_roles' => $roles
            ]);
            abort(403, 'Unauthorized - Your role ('.$request->user()->role->nama.') is not allowed');
        }
        
        return $next($request);
    }
}