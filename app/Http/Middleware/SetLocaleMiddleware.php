<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocaleMiddleware
{
    public function handle($request, Closure $next)
    {
        App::setLocale('vi'); // Ép Laravel dùng tiếng Việt
        return $next($request);
    }
}
