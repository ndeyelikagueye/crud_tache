<?php

namespace App\Http\Controllers;

use App\Http\Requests\TachesRequest;
use App\Models\Taches;
use Illuminate\Http\Request;

class TacheSecController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tache.index',['tache'=>Taches::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tache.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TachesRequest $request)
    {
        $request->validated($request->all());
        Taches::create([
            'titre'=> $request->titre,
            'description'=>$request->description,
        ]);
        return redirect()->route('tache.index')->with('Tache Creer avec succes');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(taches $tache)
    {
        return view('tache.create',compact('tache'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TachesRequest $request, taches $tache)
    {
        $request->validated($request->all());

        $tache->update([
            'titre'=> $request->titre,
            'description'=>$request->description,
        ]);
        return redirect()->route('tache.index')->with('Tache Modifier avec succes');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $tache)
    {
        Taches::destroy($tache);
        return redirect()->route('tache.index')->with('Tache supprimer avec succes');
    }
}
