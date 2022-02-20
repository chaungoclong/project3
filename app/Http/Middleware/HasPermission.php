<?php

namespace App\Http\Middleware;

use App\Exceptions\NoPermissionException;
use Closure;
use Illuminate\Http\Request;

class HasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$permissions)
    {
        $permissions = empty($permissions) ? [null] : $permissions;
        $user        = auth()->user();

        foreach ($permissions as $permission) {
            $permission = trim($permission);
            if (!$user->can($permission)) {
                throw new NoPermissionException('khong co quyen');
            }
        }
        return $next($request);
    }
}
