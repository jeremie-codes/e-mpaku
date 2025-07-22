<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membre;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class MembreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Membre::all();
        return view('members.index', [
            'members' => $members
        ]);
    }


    /**
     * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        // Règles de validation communes
        $rules = [
            // Step 1
            'cipa' => 'required|string|unique:membres,cipa,' . $request->id, // ignore unique si update
            'type_assujetti' => 'nullable|in:physique,morale',
            'commune' => 'required|string',

            // Step 2
            'nom_complet' => 'required|string',
            'sexe' => 'nullable|in:M,F',
            'nom_responsable' => 'required|string',
            'date_naissance' => 'required|date',
            'nationalite' => 'required|string',
            'activite_principale' => 'required|string',
            'lieu_exercice' => 'required|string',
            'marche' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'nullable|email',

            // Step 3
            'nif' => 'required|string',
            'rccm' => 'nullable|string',
            'affiliation_syndicale' => 'nullable|in:SNVC,Autre,Aucune',
            'possede_stand' => 'nullable|in:Oui,Non',
            'type_bien' => 'nullable|in:Propre,Loué,Public',
            'profile-img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        try {
            $validated = $request->validate($rules);

            // Traitement de l'image si présente
            $imagePath = null;
            if ($request->hasFile('profile-img')) {
                $imagePath = $request->file('profile-img')->store('members', 'public');
            }

            if ($request->id) {
                // Mise à jour d’un membre existant
                $member = Membre::findOrFail($request->id);

                // Supprimer l’ancienne image si elle existe
                if ($member->profile_photo_path && Storage::disk('public')->exists($member->profile_photo_path)) {
                    Storage::disk('public')->delete($member->profile_photo_path);
                }

                $member->update([
                    'cipa' => $validated['cipa'],
                    'type_assujetti' => $validated['type_assujetti'] ?? null,
                    'commune' => $validated['commune'],
                    'nom_complet' => $validated['nom_complet'],
                    'sexe' => $validated['sexe'] ?? null,
                    'nom_responsable' => $validated['nom_responsable'],
                    'date_naissance' => $validated['date_naissance'],
                    'nationalite' => $validated['nationalite'],
                    'activite_principale' => $validated['activite_principale'],
                    'lieu_exercice' => $validated['lieu_exercice'],
                    'marche' => $validated['marche'],
                    'telephone' => $validated['telephone'],
                    'email' => $validated['email'] ?? null,
                    'nif' => $validated['nif'],
                    'rccm' => $validated['rccm'] ?? null,
                    'affiliation_syndicale' => $validated['affiliation_syndicale'] ?? null,
                    'possede_stand' => $validated['possede_stand'] ?? null,
                    'type_bien' => $validated['type_bien'] ?? null,
                    'profile_photo_path' => $imagePath ?? $member->profile_photo_path,
                ]);

                return redirect()->back()->with('success', 'Membre mis à jour avec succès.');
            } else {
                // Création d’un nouveau membre
                Membre::create([
                    'cipa' => $validated['cipa'],
                    'type_assujetti' => $validated['type_assujetti'] ?? null,
                    'commune' => $validated['commune'],
                    'nom_complet' => $validated['nom_complet'],
                    'sexe' => $validated['sexe'] ?? null,
                    'nom_responsable' => $validated['nom_responsable'],
                    'date_naissance' => $validated['date_naissance'],
                    'nationalite' => $validated['nationalite'],
                    'activite_principale' => $validated['activite_principale'],
                    'lieu_exercice' => $validated['lieu_exercice'],
                    'marche' => $validated['marche'],
                    'telephone' => $validated['telephone'],
                    'email' => $validated['email'] ?? null,
                    'nif' => $validated['nif'],
                    'rccm' => $validated['rccm'] ?? null,
                    'affiliation_syndicale' => $validated['affiliation_syndicale'] ?? null,
                    'possede_stand' => $validated['possede_stand'] ?? null,
                    'type_bien' => $validated['type_bien'] ?? null,
                    'profile_photo_path' => $imagePath,
                ]);

                return redirect()->back()->with('success', 'Membre ajouté avec succès.');
            }

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Erreur : ' . $th->getMessage());
        }
    }

        /**
     * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        // Règles de validation communes
        $rules = [
            // Step 1
            'cipa' => 'required|string|unique:membres,cipa,' . $request->id, // ignore unique si update
            'type_assujetti' => 'nullable|in:physique,morale',
            'commune' => 'required|string',

            // Step 2
            'nom_complet' => 'required|string',
            'sexe' => 'nullable|in:M,F',
            'nom_responsable' => 'required|string',
            'date_naissance' => 'required|date',
            'nationalite' => 'required|string',
            'activite_principale' => 'required|string',
            'lieu_exercice' => 'required|string',
            'marche' => 'required|string',
            'telephone' => 'required|string',
            'email' => 'nullable|email',

            // Step 3
            'nif' => 'required|string',
            'rccm' => 'nullable|string',
            'affiliation_syndicale' => 'nullable|in:SNVC,Autre,Aucune',
            'possede_stand' => 'nullable|in:Oui,Non',
            'type_bien' => 'nullable|in:Propre,Loué,Public',
            'profile-img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];

        try {
            $validated = $request->validate($rules);

            // Traitement de l'image si présente
            $imagePath = null;
            if ($request->hasFile('profile-img')) {
                $imagePath = $request->file('profile-img')->store('members', 'public');
            }

            // Création d’un nouveau membre
            Membre::create([
                'cipa' => $validated['cipa'],
                'type_assujetti' => $validated['type_assujetti'] ?? null,
                'commune' => $validated['commune'],
                'nom_complet' => $validated['nom_complet'],
                'sexe' => $validated['sexe'] ?? null,
                'nom_responsable' => $validated['nom_responsable'],
                'date_naissance' => $validated['date_naissance'],
                'nationalite' => $validated['nationalite'],
                'activite_principale' => $validated['activite_principale'],
                'lieu_exercice' => $validated['lieu_exercice'],
                'marche' => $validated['marche'],
                'telephone' => $validated['telephone'],
                'email' => $validated['email'] ?? null,
                'nif' => $validated['nif'],
                'rccm' => $validated['rccm'] ?? null,
                'affiliation_syndicale' => $validated['affiliation_syndicale'] ?? null,
                'possede_stand' => $validated['possede_stand'] ?? null,
                'type_bien' => $validated['type_bien'] ?? null,
                'profile_photo_path' => $imagePath,
            ]);

            return response()->json([
                'success' => true, 
                'message' => 'Membre ajouté avec succès.'
            ]);
        

        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Erreur : ' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member = Membre::findOrFail($id);

        try {
            if ($member->profile_photo_path && Storage::disk('public')->exists($member->profile_photo_path)) {
                Storage::disk('public')->delete($member->profile_photo_path);
            }
            $member->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Erreur lors de la suppresion : ' . $th->getMessage());
        }

        return redirect()->route('members.index')->with('success', 'Membre supprimé avec succès!');
    }
}
