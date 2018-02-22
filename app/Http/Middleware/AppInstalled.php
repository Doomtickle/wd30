<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Storage;

class AppInstalled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! Storage::disk('public')->exists('installed')) {
            return redirect('install');
        }
        return $next($request);
    }
}
