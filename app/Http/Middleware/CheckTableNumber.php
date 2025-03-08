<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTableNumber
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // kalau sudah ada mejanya maka lanjut
        if ($request->is('scan')) {
            return $next($request);
        }

        // jika ga ada mejanya maka discan
        if (!$request->session()->has('table_number')) {
            return redirect()->route('product.scan');
        }

        return $next($request);
    }
}
