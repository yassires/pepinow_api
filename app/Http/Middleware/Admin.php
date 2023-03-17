<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Enum\UserRoleEnum;
use Illuminate\Support\Facades\Auth;


class Admin
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
        if (Auth::user()->role == UserRoleEnum::Admin) {
            return $next($request);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'you are not Admin',
            ], 401);
        }
    }
}
