<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Produits;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Alert
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $produits=null;
        $produits= Produits::all();
       view()->share('produits', $produits );
       
      
        return $next($request);
    }
}
