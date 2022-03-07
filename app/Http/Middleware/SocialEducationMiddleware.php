<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SocialEducationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     *
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            if (auth()->user()->social_education > 0) {
                return $next($request);
            }
        }

        return redirect()->route('index');
    }
}
