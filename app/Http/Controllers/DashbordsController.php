<?php

namespace App\Http\Controllers;

use App\Models\Ventes;
use App\Models\Produits;
use App\Models\Commandes;
use App\Models\Fournisseurs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashbordsController extends Controller
{
    public function TableauBord()
    {

        $i=0;  $j=0; $k=0; $o=0; $versemencduc=null; $reparationvehi=null; 
         if(Session::get('annee') !=null){$anne=Session::get('annee');} else{$anne=date('Y');}
//////les 12 mois de l'annee
           for ($i=0; $i <12 ; $i++) {
       
             if (($i+1)<10) {
                 $mois[]="0".($i+1);
             }else{
                 $mois[]=($i+1);
             }

            $ventes= Ventes::all();

             $avancevente[]= Ventes::whereMonth("created_at", $mois[$i])
                                    ->whereYear('created_at', '=', $anne)
                                    ->sum('Avance');
             $montantvente[]= Ventes::whereMonth("created_at", $mois[$i])
                                    ->whereYear('created_at', '=', $anne)
                                    ->sum('Montant');

                                }
                               // dd($versemencduc);


        $commande = Commandes::where('Etat',1)->count();
        $vente = Ventes::count();
        $fournisseur = Fournisseurs::count();
        $produit = Produits::where('Etat', 1)->count();

        return view('dashboard.index', ['commande'=>$commande,'vente'=>$vente,'fournisseur'=>$fournisseur,
        'produit'=>$produit,'avancevente'=>$avancevente,'montantvente'=>$montantvente,]);
    }

    public function anneegraphe(Request $request)
    {
      if($request->annee != null){
       $annee = $request->annee;
      }
      else{

        $annee=date('Y');
      }
      Session::put('annee',  $annee);
      return redirect()->back();
      // return json_encode(1);
    }
}
