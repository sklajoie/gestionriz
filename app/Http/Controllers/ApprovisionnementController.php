<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Produits;
use App\Models\Commandes;
use App\Models\DetailAppro;
use Illuminate\Http\Request;
use App\Models\DetailCommandes;
use App\Models\Approvisionnement;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ApprovisionnementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $approvisions= Approvisionnement::all();
        $produits= Produits::all();
        return view('approvision.index')->with([
            'approvisions'=>$approvisions,'produits'=>$produits,
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
            'refcmmd' => 'required',
            'nbrsac' => 'required',
           ]);

           $currentYear = Carbon::now()->year;
           $currentMonth = Carbon::now()->month;

           $lastReference = Approvisionnement::whereYear('created_at', $currentYear) 
                                            ->whereMonth('created_at', $currentMonth) 
                                            ->orderBy('id', 'desc') ->first();

            $maxId = $lastReference ? $lastReference->id: 0;
             $maxId++; 
             $reference = "AP"."".sprintf('%d-%02d-%04d', $currentYear, $currentMonth, $maxId);
        
             $idappro= Approvisionnement::insertGetId([
                'Reference'=> $reference,
                'Refcmmd'=> $request->refcmmd,
                'NbrTotalSac'=> $request->nombrettsac,
                'qteTotalkg'=> $request->qtettkg,
                'Etat'=> 1,
                'user_id'=>Auth::user()->id,
               ]);

           
           foreach($request->produit as $key => $idproduit)
           {

               DetailAppro::create([
                'Reference'=> $reference,
                'produit_id'=> $idproduit,
                'NombreSac'=> $request->nbrsac[$key],
                'approvisionnement_id'=>$idappro,
                'user_id'=>  Auth::user()->id,
               ]);
                        /////////////mise a jour du stock
                $modif=Produits::findOrFail($idproduit);
                $laststock = $modif->Stock;
                $newstock = $laststock + $request->nbrsac[$key];
                $modif->update(['Stock'=> $newstock]);

                // DetailCommandes::where('Reference', $request->refcmmd)
                //                  ->where('produit_id', $idproduit)
                //                  ->update(['QteApro'=> $request->nbrsac[$key]]);
            
           }


           return redirect()->back()->with('success', "l'Enregistrement a été effectué avec success");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $approvision = Approvisionnement::findOrFail($id);
        $detailApprovision = DetailAppro::where('approvisionnement_id', $id)->get();
        $produits= Produits::all();
        $commd = DetailCommandes::where('Reference', $approvision->Refcmmd)->first();
        return view('approvision.deatils')->with([
        'produits'=>$produits,'approvision'=>$approvision,
        'detailApprovision'=>$detailApprovision,'commd'=>$commd,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Approvisionnement $approvisionnement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {

            $modif=Approvisionnement::findOrFail($id);
            $reference= $modif->Reference;
        //dd($modif);
        // modification approvisionnemnt
        $modif->update([
        'NbrTotalSac'=> $request->nombrettsac,
        'qteTotalkg'=> $request->qtettkg,
        'user_id'=>Auth::user()->id,
           ]);

           // modification qte du produit 
           $modifdetailc=DetailAppro::where('approvisionnement_id',$id)->get();
           foreach($modifdetailc as $modifdetaiqte)
           {
            $produitqte = Produits::find($modifdetaiqte->produit_id);
                if ($produitqte) {
                    $newprod = $produitqte->Stock - $modifdetaiqte->NombreSac;
                    $produitqte->update(['Stock' => $newprod]);
                }
           }

            // Delete old detail rows
           DetailAppro::where('approvisionnement_id', $id)->delete();

          
           // Create new detail rows and update stock
           foreach($request->produit as $key => $idproduit)
           {
            DetailAppro::create([
                'Reference'=> $reference,
                'produit_id'=> $idproduit,
                'NombreSac'=> $request->nbrsac[$key],
                'approvisionnement_id'=>$id,
                'user_id'=>  Auth::user()->id,
               ]);


                /////////////mise a jour du stock
                $modif=Produits::findOrFail($idproduit);
                $newstock = $modif->Stock + $request->nbrsac[$key];
                $modif->update(['Stock'=> $newstock]);
                
                /////////////mise a jour du stock appro
                // DetailCommandes::where('Reference', $request->refcmmd)
                //                  ->where('produit_id', $idproduit)
                //                  ->update(['QteApro'=> $request->nbrsac[$key]]);
              
           }

        //    DetailCommandes::where('Reference', $request->refcmmd)->update(['QteApro'=> $request->qtettkg]);
        });


        return redirect()->back()->with('success', "l'Enregistrement a été modifié avec success");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Approvisionnement $approvisionnement)
    {
        //
    }

    public function registreapprovisions()
    {
        $registreAppro = DetailAppro::all();

        return view('approvision.registre', ['registreAppro'=>$registreAppro,]);
    }

    public function rechercheapproregistre(Request $request)
    {
        $date1="$request->date1 00:00:00";
        $date2="$request->date2 23:59:59";

        $registreAppro = DetailAppro::whereBetween('created_at', [$date1, $date2])->get();

        return view('approvision.registre', ['registreAppro'=>$registreAppro,]);
    }

    public function factureappro($id)
    {
        $approvi = Approvisionnement::findOrFail($id);
        $detailapprovi= DetailAppro::where('approvisionnement_id', $id)->get();
        $commande = Commandes::where('Reference', $approvi->Refcmmd)->first();
        $detacommande = DetailCommandes::where('Reference', $approvi->Refcmmd)->get();
        //dd($commande);
        return view('approvision.facture',['approvi'=>$approvi,'detailapprovi'=>$detailapprovi,'commande'=>$commande,'detacommande'=>$detacommande,]);
    }
}
