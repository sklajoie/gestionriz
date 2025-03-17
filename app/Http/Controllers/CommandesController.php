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
            'Montant'=> $request->montant,
            'Date'=> $request->date,
            'Etat'=> 1,
            'user_id'=> 1,
           ]);

           $i=0;
           foreach($request->produit as $idproduit[])
           {

               DetailCommandes::create([
                'Reference'=> $reference,
                'produit_id'=> $idproduit[$i],
                'commande_id'=> $idcmmd,
                'Qte'=> $request->qtecmd[$i],
                'prixachat'=> $request->prixachat[$i],
                'user_id'=>  Auth::user()->id,
               ]);

              $i++;
           }

           $j=0;
           if($request->qteapro !=null){
            $idappro= Approvisionnement::insertGetId([
                'Reference'=> $reference,
                'Montant'=> $request->montant,
                'Etat'=> 1,
                'user_id'=> 1,
               ]);

               foreach($request->produit as $idproduit[])
           {
            DetailAppro::create([
                'Reference'=> $reference,
                'produit_id'=> $idproduit[$j],
                'Qte'=> $request->qteapro[$j],
                'approvisionnement_id'=> $idappro,
                'user_id'=>  Auth::user()->id,
               ]);
               $j++;
           }
           }


           return redirect()->back()->with('success', "l'Enregistrement a été effectué avec success");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $command = Commandes::where('id', $id)->first();
        $commandes = DetailCommandes::where('commande_id', $id)->get();

        $fournisseurs= Fournisseurs::all();
        $produits= Produits::all();

        return view('commande.deatils')->with([
        'fournisseurs'=>$fournisseurs,'produits'=>$produits,'commandes'=>$commandes,'command'=>$command,
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
            'Montant'=> $request->montant,
            'Date'=> $request->date,
            'Etat'=> 1,
            'user_id'=> Auth::user()->id,
           ]);
           DetailCommandes::where('commande_id', $id)->delete();
           $i=0;
           foreach($request->produit as $idproduit[])
           {

               DetailCommandes::create([
                'Reference'=> $reference,
                'produit_id'=> $idproduit[$i],
                'commande_id'=> $idcmmd,
                'Qte'=> $request->qtecmd[$i],
                'prixachat'=> $request->prixachat[$i],
                'user_id'=> Auth::user()->id,
               ]);

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
}
