<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminOrSuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        // Kiểm tra nếu user là Admin hoặc SuperAdmin
        if ($user && ($user->role_as == '1' || $user->role_as == '2')) {
            return $next($request);
        }

        // Nếu không phải, từ chối truy cập
        abort(403, 'Access denied');
    }
}
