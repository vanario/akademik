<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Support\Facades\Auth;

class SiswaMiddleware
{
    
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->level == '4') {
        	return $next($request);
        }
        return redirect()->route('home');
        
    }
}