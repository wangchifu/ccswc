<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SectionMiddleware
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
            if (auth()->user()->code == '079999') {
                return $next($request);
            }
        }

        return redirect()->route('index');
    }
}
