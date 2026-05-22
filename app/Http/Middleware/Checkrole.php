<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Checkrole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if ($request->user() && $request->user()->role !== $role) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak, Anda tidak memiliki akses ke halaman ini'
            ], 403);
        }

        return $next($request);
    }
}
