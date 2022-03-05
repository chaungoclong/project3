<?php

namespace App\Http\Middleware;

use App\Exceptions\NoPermissionException;
use Closure;
use Illuminate\Http\Request;

class ExceptRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $roles = empty($roles) ? [null] : $roles;
        $user = auth()->user();

        foreach ($roles as $role) {
            $role = trim($role);

            if ($user->hasRole($role)) {
                throw new NoPermissionException('Không có quyền truy cập');
            }
        }

        return $next($request);
    }
}
