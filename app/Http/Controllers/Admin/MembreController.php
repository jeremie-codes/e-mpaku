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
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

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

        // dd($request->all());

        $memberexisted = null;
        
        if($request->id) {
            $memberexisted = Membre::findOrFail($request->id);

            try {

                // Valider les données de base
                $validated = $request->validate([
                    'ref' => 'required|string|max:255',
                    'sec_ref' => 'nullable|string|max:255',
                    'firstname' => 'required|string|max:255',
                    'lastname' => 'nullable|string|max:255',
                    'commune' => 'required|string|max:255',
                    'profile-img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                if ($memberexisted->profile_photo_path && Storage::disk('public')->exists($memberexisted->profile_photo_path)) {
                    Storage::disk('public')->delete($memberexisted->profile_photo_path);
                }

                // Traitement de l'image si présente
                $imagePath = null;
                if ($request->hasFile('profile-img')) {
                    $imagePath = $request->file('profile-img')->store('members', 'public');
                }

                // Mise à jour du membre
                $memberexisted->update([
                    'ref' => $validated['ref'],
                    'sec_ref' => $validated['sec_ref'] ?? null,
                    'firstname' => $validated['firstname'],
                    'lastname' => $validated['lastname'] ?? null,
                    'commune' => $validated['commune'],
                    'profile_photo_path' => $imagePath,
                ]);

                return redirect()->back()->with('success', 'Membre mis à jour avec succès.');

            } catch (\Throwable $th) {
                return redirect()->back()->with('error', 'Erreur lors de la mise à jour: ' . $th->getMessage());
            }
        }

        try {
            // Valider les données de base
            $validated = $request->validate([
                'ref' => 'required|string|max:255',
                'sec_ref' => 'nullable|string|max:255',
                'firstname' => 'required|string|max:255',
                'lastname' => 'nullable|string|max:255',
                'commune' => 'required|string|max:255',
                'profile-img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            // Traitement de l'image si présente
            $imagePath = null;
            if ($request->hasFile('profile-img')) {
                $imagePath = $request->file('profile-img')->store('members', 'public');
            }

            // Création du membre
            $member = Membre::create([
                'ref' => $validated['ref'],
                'sec_ref' => $validated['sec_ref'] ?? null,
                'firstname' => $validated['firstname'],
                'lastname' => $validated['lastname'] ?? null,
                'commune' => $validated['commune'],
                'profile_photo_path' => $imagePath,
            ]);

            return redirect()->back()->with('success', 'Membre ajouté avec succès.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout : ' . $th->getMessage());
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
