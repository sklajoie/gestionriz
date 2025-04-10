<?php

namespace App\Http\Controllers;

use App\Models\GestionCaisse;
use App\Models\Natures;
use App\Models\Ressources;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GestionCaisseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $caisses=GestionCaisse::SELECT('id', 'TypeBeneficier','Beneficiaire','TypeMouvement','Montant','modePaiement','supprimer',
                                'Numero','Decharche','Date','Detail','user_id','ressource_id','membre_id',)
                ->WHERE("supprimer", 0)
                ->OrderBy('id','DESC')
                ->get();

                $employers=User::WHERE('supprimer', 0)
                                ->orderBy('name')
                                ->get();
        return view('caisse.index')->with(['caisses'=>$caisses,'employers'=>$employers,]);
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
            'beneficiare' => 'required',
            'type_mouvement' => 'required',
            'nature_mouvement' => 'required',
            'montant' => 'required',
            'rubrique_mouvement' => 'required',
           ]);
// dd($request->all());
            $numm=null;
            $newmontant=0;
            if($request->nummobile !=null){
                $numm=$request->nummobile;
            }elseif($request->banque !=null || $request->cheque !=null  ){
                    $numm= $request->banque."/".$request->cheque;
            }
            
                if($request->paiement == null){
                $modepaiement="RSPECE";
                }else{$modepaiement=$request->paiement;}
// dd($modepaiement);
                if($request->type_benef == "Membre")
                {
                    $membreid=$request->beneficiare;
                }else{$membreid =Auth::user()->id; }
                    if( !empty($request->decharge))
                    {
                 $imageTempName = $request->file('decharge')->getPathname();
				$imageName = $request->file('decharge')->getClientOriginalName();
                $newImageName = time() . '_' . $imageName;
				$path = 'images/Compta/';
				$request->file('decharge')->move($path , $newImageName); 
                    }else{$newImageName = null;}

                    if( !empty($request->decharge2))
                    {
                 $imageTempName = $request->file('decharge2')->getPathname();
				$imageName2 = $request->file('decharge2')->getClientOriginalName();
                $newImageName2 = time() . '_' . $imageName2;
				$path2 = 'images/Compta/';
				$request->file('decharge2')->move($path2 , $newImageName2); 
                    }else{$newImageName2 = null;}
    //dd($membreid);
           GestionCaisse::create([
                    'TypeBeneficier'=> $request->type_benef,
                    'Beneficiaire'=> $request->beneficiare,
                    'TypeMouvement'=> $request->type_mouvement,
                    // 'nature_id'=> $request->nature_mouvement,
                    'ressouce_id'=> $request->rubrique_mouvement,
                    'membre_id'=> $membreid,
                    'Montant'=> $request->montant,
                    'Date'=> $request->date,
                    'Decharche'=> $newImageName,
                    'AutreDoc'=> $newImageName2,
                    'modePaiement'=> $modepaiement,
                    'Numero'=> $numm,
                    'Detail'=> $request->commentaire,
                    'user_id'=> Auth::user()->id,
           ]);

        //dd($update);
         return redirect()->back()->with('success', "l'Enregistrement a été effectué avec success");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $caisses= GestionCaisse::Where('id', $id)->first();

        return view("caisse.edit")->with([
           "caisses"=>$caisses,
       ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GestionCaisse $gestionCaisse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'beneficiare' => 'required',
            'type_mouvement' => 'required',
            'naturemouvement' => 'required',
            'montant' => 'required',
           ]);
 //dd($request->all());
            $numm=null;
            $newmontant=0;
            if($request->nummobile !=null){
                $numm=$request->nummobile;
            }elseif($request->banque !=null || $request->cheque !=null  ){
                    $numm= $request->banque."/".$request->cheque;
            }
            
             if($request->paiement == null){
                $modepaiement=$request->modepaiement;
                }else{$modepaiement=$request->paiement;}

//  dd($modepaiement);
                if($request->type_benef == "Membre")
                {
                    $membreid=$request->beneficiare;
                }else{$membreid =Auth::user()->id; }

                $modifcaiss=GestionCaisse::findOrFail($id);
                
                if( !empty($request->decharge))
                {
             $imageTempName = $request->file('decharge')->getPathname();
            $imageName = $request->file('decharge')->getClientOriginalName();
            $newImageName = time() . '_' . $imageName;
            $path = 'images/Compta/';
            $request->file('decharge')->move($path , $newImageName); 
                }else{$newImageName = $modifcaiss->Decharche;}

                if( !empty($request->decharge2))
                {
             $imageTempName = $request->file('decharge2')->getPathname();
            $imageName2 = $request->file('decharge2')->getClientOriginalName();
            $newImageName2 = time() . '_' . $imageName2;
            $path2 = 'images/Compta/';
            $request->file('decharge2')->move($path2 , $newImageName2); 
                }else{$newImageName2 = $modifcaiss->AutreDoc;}
                
           
           $modifcaiss->update([
                    'TypeBeneficier'=> $request->type_benef,
                    'Beneficiaire'=> $request->beneficiare,
                    'TypeMouvement'=> $request->type_mouvement,
                    // 'nature_id'=> $request->naturemouvement,
                    'ressouce_id'=> $request->rubrique_mouvement,
                    'membre_id'=> $membreid,
                    'Montant'=> $request->montant,
                    'Date'=> $request->date,
                    'Decharche'=> $newImageName,
                    'AutreDoc'=> $newImageName2,
                    'modePaiement'=> $modepaiement,
                    'Numero'=> $numm,
                    'Detail'=> $request->commentaire,
                    'user_id'=> Auth::user()->id,
           
           ]);

       return back()->with('success', "l'Enregistrement a été modifié avec success");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        $modif=GestionCaisse::findOrFail($id);
        $modif->update(['supprimer'=> 1,'user_id'=> Auth::user()->id, ]);

return back()->with('success', "l'Enregistrement a été Supprimeé avec success");

    }


    public function recherchetypemvmt($type)
    {
        $typ=$type;
       
          $data['data']= Natures::WHERE('Type',"$typ")->get();

       return response()->json($data);
       
    }
    public function recherchenaturemvmt($id)
    {
        $naturs=$id;
       
          $data['data']= Ressources::WHERE('nature_id',"$naturs")->get();

       return response()->json($data);
       
    }


}
