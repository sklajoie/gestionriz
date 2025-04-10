<?php

namespace App\Http\Middleware;

use App\Models\Natures;
use Closure;
use App\Models\Produits;
use App\Models\User;
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
        $avancevente=null;
       view()->share('avancevente', $avancevente );
        $montantvente=null;
       view()->share('montantvente', $montantvente );
       
        $natures=null;
        $natures= Natures::all();
       view()->share('natures', $natures  );
        $employers=null;
        $employers= User::all();
       view()->share('employers', $employers  );
       
      
        return $next($request);
    }
}
