<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membre;
use App\Models\Paiement;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paiements = Paiement::all();
        return view('paiements.index', [
            'paiements' => $paiements,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $request)
    {
        $query = $request->get('q');

        $membres = Membre::where('firstname', 'like', '%' . $query . '%')
            ->orWhere('lastname', 'like', '%' . $query . '%')
            ->orWhere('ref', 'like', '%' . $query . '%')
            ->limit(10)
            ->get();

        return response()->json($membres);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $paiementexisted = null;
        
        if($request->id) {
            $paiementexisted = Paiement::findOrFail($request->id);

            try {
                // Valider les données de base
                $validated = $request->validate([
                    'montant' => 'required|numeric',
                ]);

                // Création du membre
                $paiementexisted->update([
                    'montant' => $validated['montant'],
                ]);

                return redirect()->back()->with('success', 'Mise à jour effectué avec succès.');
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', 'Erreur lors de la mise à jour : ' . $th->getMessage());
            }
        }

        try {
            // Valider les données de base
            $validated = $request->validate([
                'membre_id' => 'required|numeric',
                'montant' => 'required|numeric',
            ]);

            // Création du membre
            $paiement = Paiement::create([
                'membre_id' => $validated['membre_id'],
                'montant' => $validated['montant'],
            ]);

            return redirect()->back()->with('success', 'Paiement effectué avec succès.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Erreur lors du paiement : ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paiement = Paiement::findOrFail($id);
        $paiement->delete();

        return redirect()->route('paiements.index')->with('success', 'Paiement supprimé avec succès!');
    }
}
