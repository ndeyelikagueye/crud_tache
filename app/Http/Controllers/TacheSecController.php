<?php

namespace App\Http\Controllers;

use App\Http\Requests\TachesRequest;
use App\Models\Taches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        /*
         * Utilise hasFile('photo') pour vérifier si une photo a été envoyée
         *Si oui, stocke l'image dans storage/app/public/photos
          *Enregistre le chemin de la photo dans la base (et non le fichier lui-même)
         * */
        $photoPath = null;

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }
        Taches::create([
            'titre'=> $request->titre,
            'description'=>$request->description,
            'photo' => $photoPath,
        ]);

        return redirect()->route('tache.index')->with('Tache Creer avec succes');
    }

    /**
     * Display the specified resource.
     */


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
        $photoPath = $tache->photo; // garder l'ancienne photo par défaut
        if ($request->hasFile('photo')) {
            // supprimer l'ancienne photo si elle existe
            if ($tache->photo && Storage::disk('public')->exists($tache->photo)) {
                Storage::disk('public')->delete($tache->photo);
            }
            // stocker la nouvelle photo
            $photoPath = $request->file('photo')->store('photos', 'public');
        }
        $tache->update([
            'titre'=> $request->titre,
            'description'=>$request->description,
            'photo' => $photoPath,
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
