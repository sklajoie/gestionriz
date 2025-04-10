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
        $produits= Produits::where('soumisCommande', 1)->get();
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
            'qtecmmd'=> $request->ttqtecmmd,
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
                'QteApro'=> 0,
                'prixachat'=> $request->prixachat[$i],
                'user_id'=>  Auth::user()->id,
               ]);

              $i++;
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
        $produits= Produits::where('soumisCommande', 1)->get();

        return view('commande.deatils')->with([
        'fournisseurs'=>$fournisseurs,'produits'=>$produits,'commandes'=>$commandes,
        'command'=>$command,
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
        //dd($request->ttqtecmmd);

        $modif->update([
            'fournisseur_id'=> $request->fourniss,
            'Montant'=> $request->montantcmd,
            'Date'=> $request->date,
            'qtecmmd'=> $request->ttqtecmmd,
            'user_id'=> Auth::user()->id,
           ]);

           
           DetailCommandes::where('commande_id', $id)->delete();
          
           foreach($request->produit as $key => $idproduit)
           {

               DetailCommandes::create([
                'Reference'=> $reference,
                'produit_id'=> $idproduit,
                'commande_id'=> $idcmmd,
                'Qte'=> $request->qtecmd[$key],
                'prixachat'=> $request->prixachat[$key],
                'user_id'=> Auth::user()->id,
               ]);

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
    public function rechercheregistrecommande(Request $request)
    {
        $date1="$request->date1 00:00:00";
        $date2="$request->date2 23:59:59";

        $commandes = DetailCommandes::whereBetween('created_at', [$date1, $date2])->get();

        return view('commande.registre')->with(['commandes'=>$commandes]);
    }

    public function facturecommende($id)
    {
        $commande = Commandes::findOrFail($id);
        $detailcmmds= DetailCommandes::where('commande_id', $id)->get();
          //  dd($commande, $id);
        return view('commande.facture',['commande'=>$commande,'detailcmmds'=>$detailcmmds]);
    }

   

    public function rechercheqtecommande($id)
    {
        //$rep = Produits::select('Prix')->where('id', $id)->first();
        
        $rep = Commandes::where('Reference', $id)->value('qtecmmd');
        return response()->json(['rep' => $rep]);
    }
    public function rechercheKgArticle($id)
    {
        //$rep = Produits::select('Prix')->where('id', $id)->first();
        
        $rep = Produits::where('id', $id)->value('qtesac');
        return response()->json(['rep' => $rep]);
    }

   
}
