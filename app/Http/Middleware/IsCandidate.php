<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsCandidate
{
    const ROLE_CANDIDATE = 1;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->role != self::ROLE_CANDIDATE) {
            die(auth()->user()->role);
            return redirect()->route('home');
        }
        return $next($request);
    }
}
