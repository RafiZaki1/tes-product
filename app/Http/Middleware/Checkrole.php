<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $roleRequired): Response
    {
        if (!$request->user()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated. Silakan login terlebih dahulu.'
            ], 401);
        }

        if ($request->user()->role !== $roleRequired) {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak! Rute ini hanya boleh diakses oleh ' . ucfirst($roleRequired) . '.'
            ], 403); 
        }
        return $next($request);
    }
}