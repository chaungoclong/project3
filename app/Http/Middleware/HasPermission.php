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
        $permissions = trimStringArray($permissions);

        if (!\Gate::check($permissions)) {
            throw new NoPermissionException(
                __('unauthorized to do', ['action' => 'truy cập'])
            );
        }

        return $next($request);
    }
}
