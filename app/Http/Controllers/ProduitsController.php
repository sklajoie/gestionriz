<?php

namespace App\Http\Controllers;

use App\Models\Produits;
use Illuminate\Http\Request;

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
            'stock' => 'required',
            'prix' => 'required',
           ]);

           Produits::create([
            'Designation'=> $request->designation,
            'Stock'=> $request->stock,
            'Prix'=> $request->prix,
            'Etat'=> 1,
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
            'stock' => 'required',
            'prix' => 'required',
           ]);

           $modif=Produits::findOrFail($id);
           $modif->update([
            'Designation'=> $request->designation,
            'Stock'=> $request->stock,
            'Prix'=> $request->prix,
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
