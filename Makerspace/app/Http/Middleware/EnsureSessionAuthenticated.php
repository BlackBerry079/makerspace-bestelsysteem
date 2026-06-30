<?php

namespace App\Http\Middleware;

use App\Support\SessionAuth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSessionAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! SessionAuth::check()) {
            return redirect()
                ->to(route('orders.index') . '#nieuwe-bestelling')
                ->with('auth_required', 'Je moet eerst inloggen om een bestelling te plaatsen.');
        }

        return $next($request);
    }
}
