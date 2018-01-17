<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Support\Facades\Auth;

class LevelMiddleware
{
    
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->level == '1') {
        	return $next($request);
        }
        return redirect()->route('home');
        
    }
}
