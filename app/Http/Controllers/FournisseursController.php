<?php

namespace App\Http\Controllers;

use App\Models\Fournisseurs;
use Illuminate\Http\Request;

class FournisseursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fourniss = Fournisseurs::all();
        return view('fournisseur.index')->with(['fourniss'=>$fourniss,]);
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
            'nom' => 'required',
            'contact' => 'required',
           ]);

           Fournisseurs::create([
            'Nom'=> $request->nom,
            'Contact'=> $request->contact,
            'Ville'=> $request->ville,
            'Address'=> $request->address,
           ]);

           return redirect()->back()->with('success', "l'Enregistrement a été effectué avec success");

    }

    /**
     * Display the specified resource.
     */
    public function show(Fournisseurs $fournisseurs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fournisseurs $fournisseurs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'nom' => 'required',
            'contact' => 'required',
           ]);

           $modif=Fournisseurs::findOrFail($id);
           $modif->update([
            'Nom'=> $request->nom,
            'Contact'=> $request->contact,
            'Ville'=> $request->ville,
            'Address'=> $request->address,
           ]);

           return redirect()->back()->with('success', "l'Enregistrement a été modifié avec success");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fournisseurs $fournisseurs)
    {
        //
    }
}
