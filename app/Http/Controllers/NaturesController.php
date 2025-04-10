<?php

namespace App\Http\Controllers;

use App\Models\Natures;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NaturesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $natures = Natures::WHERE('supprimer', 0)->get();

            return view('caisse.nature')->with([
                'natures'=>$natures,
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
            'type' => 'required',
           ]);

          
            Natures::create([
                    'Type'=> $request->type,
                    'Nature'=> $request->nature,
                    'user_id'=> Auth::user()->id,
           ]);

    return back()->with('success', "l'Enregistrement a été effectué avec success");
    }

    /**
     * Display the specified resource.
     */
    public function show(Natures $natures)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Natures $natures)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'nature' => 'required',
            'type' => 'required',
           ]);

          
            $modif=Natures::findOrFail($id);
            $modif->update([
                    'Type'=> $request->type,
                    'Nature'=> $request->nature,
                    'user_id'=> Auth::user()->id,
           ]);

    return back()->with('success', "l'Enregistrement a été modifié avec success");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $modif=Natures::findOrFail($id);
        $modif->update([ 'supprimer'=>1, 'user_id'=> Auth::user()->id, ]);

        return back()->with('success', "l'Enregistrement a été supprimé avec success");
    }
}
