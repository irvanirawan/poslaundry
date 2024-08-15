<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class WebAndApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah ada user yang sedang login melalui 'web' atau 'api'
        $user = Auth::guard('web')->user() ?: Auth::guard('api')->user();

        if ($user) {
            // Set data user ke dalam request sehingga bisa diakses di controller
            $request->setUserResolver(function () use ($user) {
                return $user;
            });

            // Set user di Auth facade agar bisa diakses dengan Auth::user()
            Auth::setUser($user);
            \Log::info('User from middleware:', ['user' => $user]);
        } else {
            \Log::info('No authenticated user found');
        }

        return $next($request);
    }
}
