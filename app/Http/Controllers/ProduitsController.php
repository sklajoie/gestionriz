<?php

namespace App\Http\Controllers;

use App\Models\Produits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProduitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produits = Produits::all();

        return view('produit.index')->with([
            'produits'=>$produits,
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
            'designation' => 'required',
            'qtesac' => 'required',
            'prix' => 'required',
           ]);

           Produits::create([
            'Designation'=> $request->designation,
            'qtesac'=> $request->qtesac,
            'Prix'=> $request->prix,
            'soumisCommande'=> $request->cmmd,
            'Etat'=> 1,
            'user_id'=> Auth::user()->id,
           ]);

           return redirect()->back()->with('success', "l'Enregistrement a été effectué avec success");

    }

    /**
     * Display the specified resource.
     */
    public function show(Produits $produits)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produits $produits)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'designation' => 'required',
            'qtesac' => 'required',
            'prix' => 'required',
           ]);

           $modif=Produits::findOrFail($id);
           $modif->update([
            'Designation'=> $request->designation,
            'qtesac'=> $request->qtesac,
            'Prix'=> $request->prix,
            'soumisCommande'=> $request->cmmd,
           ]);

           return redirect()->back()->with('success', "l'Enregistrement a été modifié avec success");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produits $produits)
    {
        //
    }
}
