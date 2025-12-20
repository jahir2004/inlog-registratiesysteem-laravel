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

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $userRole = strtolower($user->rolename ?? '');

        $allowedRoles = [];
        foreach ($roles as $role) {
            foreach (explode(',', (string) $role) as $r) {
                $r = strtolower(trim($r));
                if ($r !== '') {
                    $allowedRoles[] = $r;
                }
            }
        }

        if (!in_array($userRole, $allowedRoles, true)) {
            abort(403, 'Onvoldoende rechten.');
        }

        return $next($request);
    }
}
