<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Produits;
use App\Models\Commandes;
use App\Models\DetailAppro;
use App\Models\Fournisseurs;
use Illuminate\Http\Request;
use App\Models\DetailCommandes;
use App\Models\Approvisionnement;
use Illuminate\Support\Facades\Auth;

class CommandesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commandes= Commandes::all();
        $fournisseurs= Fournisseurs::all();
        $produits= Produits::all();
        return view('commande.index')->with([
            'commandes'=>$commandes,'fournisseurs'=>$fournisseurs,'produits'=>$produits,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'date' => 'required',
            'produit' => 'required',
            'qtecmd' => 'required',
           ]);

           $currentYear = Carbon::now()->year;
           $currentMonth = Carbon::now()->month;

           $lastReference = Commandes::whereYear('created_at', $currentYear) 
                                            ->whereMonth('created_at', $currentMonth) 
                                            ->orderBy('id', 'desc') ->first();

            $maxId = $lastReference ? $lastReference->id: 0;
             $maxId++; 
             $reference = "C"."".sprintf('%d-%02d-%04d', $currentYear, $currentMonth, $maxId);
        
          $idcmmd= Commandes::insertGetId([
            'fournisseur_id'=> $request->fourniss,
            'Reference'=> $reference,
            'Montant'=> $request->montantcmd,
            'Date'=> $request->date,
            'Etat'=> 1,
            'user_id'=> Auth::user()->id,
           ]);

           $i=0;
           foreach($request->produit as $idproduit[])
           {

               DetailCommandes::create([
                'Reference'=> $reference,
                'produit_id'=> $idproduit[$i],
                'commande_id'=> $idcmmd,
                'Qte'=> $request->qtecmd[$i],
                'QteApro'=> $request->qteapro[$i],
                'prixachat'=> $request->prixachat[$i],
                'user_id'=>  Auth::user()->id,
               ]);
                        /////////////mise a jour du stock
                $modif=Produits::findOrFail($idproduit[$i]);
                $laststock = $modif->Stock;
                $newstock = $laststock + $request->qteapro[$i];
                $modif->update(['Stock'=> $newstock]);

              $i++;
           }

            $idappro= Approvisionnement::insertGetId([
                'Reference'=> $reference,
                'Montant'=> $request->montantapro,
                'Etat'=> 1,
                'user_id'=>Auth::user()->id,
               ]);


           return redirect()->back()->with('success', "l'Enregistrement a été effectué avec success");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $command = Commandes::where('id', $id)->first();
        $commandes = DetailCommandes::where('commande_id', $id)->get();
        $montantapro = Approvisionnement::select('Montant')->where('Reference',  $command->Reference)->value('Montant');

        $fournisseurs= Fournisseurs::all();
        $produits= Produits::all();

        return view('commande.deatils')->with([
        'fournisseurs'=>$fournisseurs,'produits'=>$produits,'commandes'=>$commandes,
        'command'=>$command,'montantapro'=>$montantapro,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Commandes $commandes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $modif=Commandes::findOrFail($id);
        $reference= $modif->Reference;
        $idcmmd= $id;
        //dd($modif);

        $modif->update([
            'fournisseur_id'=> $request->fourniss,
            'Reference'=> $reference,
            'Montant'=> $request->montantcmd,
            'Date'=> $request->date,
            'Etat'=> 1,
            'user_id'=> Auth::user()->id,
           ]);
           $idappro=Approvisionnement::where('Reference', $reference)->first();
           $idappro->update([
            'Reference'=> $reference,
            'Montant'=> $request->montantapro,
            'Etat'=> 1,
            'user_id'=> Auth::user()->id,
           ]);

           $modifdetailc=DetailCommandes::where('commande_id',$id)->get();
           foreach($modifdetailc as $modifdetaiqte)
           {
             $produitqte=Produits::where('id',$modifdetaiqte->produit_id)->first();
             $qteprod=$produitqte->Stock;
             $lastprod = $modifdetaiqte->QteApro;
             $newprod = $qteprod-$lastprod;
             $produitqte->update(['Stock'=> $newprod]);
           }


           DetailCommandes::where('commande_id', $id)->delete();
           $i=0;
           foreach($request->produit as $idproduit[])
           {

               DetailCommandes::create([
                'Reference'=> $reference,
                'produit_id'=> $idproduit[$i],
                'commande_id'=> $idcmmd,
                'Qte'=> $request->qtecmd[$i],
                'QteApro'=> $request->qteapro[$i],
                'prixachat'=> $request->prixachat[$i],
                'user_id'=> Auth::user()->id,
               ]);


                /////////////mise a jour du stock
                $modif=Produits::findOrFail($idproduit[$i]);
                $laststock = $modif->Stock;
                $newstock = $laststock + $request->qteapro[$i];
                $modif->update(['Stock'=> $newstock]);
     
              $i++;
           }

           

        return redirect()->back()->with('success', "l'Enregistrement a été modifié avec success");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commandes $commandes)
    {
        //
    }

    public function registrecommande()
    {
        $commandes = DetailCommandes::get();

        return view('commande.registre')->with(['commandes'=>$commandes]);
    }
}
