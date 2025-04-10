<?php

namespace App\Http\Controllers;

use App\Models\DetailVentes;
use Carbon\Carbon;
use App\Models\Ventes;
use App\Models\Produits;
use App\Models\Versements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    return view('vente.index')->with([

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
 //dd($request->all());

        $this->validate($request,[
            'nqte' => 'required',
            'ind' => 'required',
           ]);

           $numm=null;
           if($request->nummobile !=null){
            $numm=$request->nummobile;
        }elseif($request->banque !=null || $request->cheque !=null  ){
                $numm= $request->banque."/".$request->cheque;
        }
        if($request->paiement && $numm !=null ){
            $moyen=$request->paiement."/".$numm;
        }elseif($request->paiement && $numm ==null){$moyen=$request->paiement;}
        else{$moyen="ESPECE";}

           $currentYear = Carbon::now()->year;
           $currentMonth = Carbon::now()->month;

           $lastReference = Ventes::whereYear('created_at', $currentYear) 
                                            ->whereMonth('created_at', $currentMonth) 
                                            ->orderBy('id', 'desc') ->first();

            $maxId = $lastReference ? $lastReference->id: 0;
             $maxId++; 
             $reference = "V"."".sprintf('%d-%02d-%04d', $currentYear, $currentMonth, $maxId);

             $etat="SOLDE";
             if($request->solde >0){$etat="NON SOLDE";}
             
         $idvent= Ventes::insertGetId([
            'Reference'=> $reference,
            'Montant'=> $request->totalttc,
            'Avance'=> $request->avance,
            'Solde'=> $request->solde,
            'Client'=> $request->nomclient,
            'Contact'=> $request->numeroclient,
            'Tht'=> $request->totalht,
            'Remise'=> $request->remise,
            'Tva'=> $request->tva,
            'Etat'=> $etat,
            'user_id'=> Auth::user()->id,
           ]);

           $i=0;
           foreach($request->ind as $idproduit[])
           {

           DetailVentes::create([
            'Reference'=> $reference,
            'QteVente'=> $request->nqte[$i],
            'vente_id'=> $idvent,
            'PrixVente'=> $request->myDataPrix[$i],
            'MontantVente'=> $request->total[$i],
            'produit_id'=> $idproduit[$i],
           ]);

           $modif=Produits::findOrFail($idproduit[$i]);
           $laststock = $modif->Stock;
           $newstock = $laststock - $request->nqte[$i];
           $modif->update(['Stock'=> $newstock]);

           $i++;
        }

           Versements::create([
            'Reference'=> $reference,
            'Montant'=> $request->avance,
            'Moyen'=> $moyen,
            'user_id'=> Auth::user()->id,
           ]);


           return redirect()->back()->with('success', "l'Enregistrement a été effectué avec success");

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        
        $ventes = Ventes::where('id', $id)->first();
        $detailventes = DetailVentes::where('Reference', $ventes->Reference)->get();
        $produits=Produits::All();

        return view('vente.edit')->with([
            'ventes'=>$ventes,'detailventes'=>$detailventes,'produits'=>$produits,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ventes $ventes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'nqte' => 'required',
            'idproduit' => 'required',
           ]);

           

           $modif=Ventes::findOrFail($id);
           $reference=$modif->Reference;

           $modifdetailv=DetailVentes::where('vente_id',$id)->get();
           foreach($modifdetailv as $modifdetaiqte)
           {
             $produitqte=Produits::where('id',$modifdetaiqte->produit_id)->first();
             $qteprod=$produitqte->Stock;
             $lastprod = $modifdetaiqte->QteVente;
             $newprod = $lastprod + $qteprod;
             $produitqte->update(['Stock'=> $newprod]);
           }

             $etat="SOLDE";
             if($request->solde >0){$etat="NON SOLDE";}
             
             $modif->update([
            'Montant'=> $request->totalttc,
            'Avance'=> $request->avance,
            'Solde'=> $request->solde,
            'Client'=> $request->client,
            'Contact'=> $request->contant,
            'Tht'=> $request->totalht,
            'Remise'=> $request->remise,
            'Tva'=> $request->tva,
            'Etat'=> $etat,
            'user_id'=> Auth::user()->id,
           ]);
           foreach($modifdetailv as $modifdetaiqte)
           {
             $produitqte=DetailVentes::where('id',$modifdetaiqte->id)->delete();
           }

           $i=0;
           foreach($request->idproduit as $idproduit[])
           {

           DetailVentes::create([
            'Reference'=> $reference,
            'QteVente'=> $request->nqte[$i],
            'vente_id'=> $id,
            'PrixVente'=> $request->myDataPrix[$i],
            'MontantVente'=> $request->total[$i],
            'produit_id'=> $idproduit[$i],
           ]);

           $modif=Produits::findOrFail($idproduit[$i]);
           $laststock = $modif->Stock;
           $newstock = $laststock - $request->nqte[$i];
           $modif->update(['Stock'=> $newstock]);

           $i++;
        }
        $versmt= Versements::where('Reference', $reference)->first();
        $versmt->update(['Montant'=> $request->avance,'user_id'=> Auth::user()->id,]);


           return redirect()->back()->with('success', "l'Enregistrement a été effectué avec success");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ventes $ventes)
    {
        //
    }

    public function recuperations(Request $request)
    {
        $data= Produits::all();

        return response()->json($data);
    }
    public function modificationvente($id)
    {
        $dataproduit= Produits::all();
        $ventes = Ventes::where('id', $id)->first();
        $datta = DetailVentes::where('Reference', $ventes->Reference)->get();

        return response()->json($datta);
    }
    public function recherchearticle($id)
    {
        //$rep = Produits::select('Prix')->where('id', $id)->first();
        
        $rep = Produits::where('id', $id)->value('Prix');
        return response()->json(['rep' => $rep]);
    }

    public function listeVentes()
    {
        
        $ventes = Ventes::all();

        return view('vente.liste')->with([
            'ventes'=>$ventes,
        ]);
    }
    public function registrevente()
    {
        
        $ventes = Ventes::all();
        $detailsv= DetailVentes::get();
        return view('vente.registre')->with([
            'ventes'=>$ventes,'detailsv'=>$detailsv,
        ]);
    }
    public function rechercheregistre( Request $request)
    {
        $date1="$request->date1 00:00:00";
        $date2="$request->date2 23:59:59";

        $ventes = Ventes::all();
        $detailsv= DetailVentes::whereBetween('created_at', [$date1, $date2])->get();
        
        return view('vente.registre')->with([
            'ventes'=>$ventes,'detailsv'=>$detailsv,
        ]);
    }

    public function facturevente($id)
    {
        $ventes = Ventes::findOrFail($id)->first();
        $detailvents= DetailVentes::where('vente_id', $id)->get();

        return view('vente.facture',['ventes'=>$ventes,'detailvents'=>$detailvents]);
    }
}
