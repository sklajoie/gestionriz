<?php

namespace App\Http\Controllers;

use App\Models\GestionCaisse;
use App\Models\Ressources;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RessourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ressources = Ressources::WHERE('supprimer', 0)->OrderBy('id','DESC')->get();

        return view('caisse.ressource')->with([
        'ressources'=>$ressources,
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
            'nature' => 'required',
            'rubrique' => 'required',
           ]);

          
            Ressources::create([
                    'nature_id'=> $request->nature,
                    'Rubrique'=> $request->rubrique,
                    'Autre'=> $request->observation,
                    'user_id'=> Auth::user()->id,
           ]);

    return back()->with('success', "l'Enregistrement a été effectué avec success");

    }

    /**
     * Display the specified resource.
     */
    public function show(Ressources $ressources)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ressources $ressources)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'nature' => 'required',
             'rubrique' => 'required',
            ]);
 
           
           
            $modif=Ressources::findOrFail($id);
             $modif->update([
                     'nature_id'=> $request->nature,
                     'Rubrique'=> $request->rubrique,
                     'Autre'=> $request->observation,
                     'user_id'=> Auth::user()->id,
 
                     
            ]);
  return back()->with('success', "l'Enregistrement a été Modifié avec success");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
            $modif=Ressources::findOrFail($id);
            $modif->update(['supprimer'=> 1,'user_id'=> Auth::user()->id, ]);

 return back()->with('success', "l'Enregistrement a été Supprimeé avec success");
    }
}
