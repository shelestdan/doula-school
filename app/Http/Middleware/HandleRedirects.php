<?php

namespace App\Http\Middleware;

use App\Domain\Seo\Models\Redirect;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleRedirects
{
    public function handle(Request $request, Closure $next): Response
    {
        $path = '/' . ltrim($request->path(), '/');

        $redirect = Redirect::active()
            ->where('from_path', $path)
            ->first();

        if ($redirect) {
            return response()->redirectTo($redirect->to_path, $redirect->code);
        }

        return $next($request);
    }
}
