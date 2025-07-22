<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use App\Models\Paiement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RouteController extends Controller
{
    public function index() {
        $user = auth()->user();
        $membres = Membre::all();
        $sommeByDate = Paiement::whereDate('created_at', now()->format('Y-m-d'))->sum('montant') ?? 0;
        $sommeGlobal = Paiement::sum('montant') ?? 0;

        return view('index', [
            'user' => $user,
            'membres' => $membres,
            'sommeByDate' => $sommeByDate,
            'sommeGlobal' => $sommeGlobal,
            'paiementsByDate' => Paiement::whereDate('created_at', now()->format('Y-m-d'))->orderBy('created_at', 'desc')->paginate(10),
        ]);
    }

    public function all(Request $request) {
        $users = User::all();
        return response()->json([
            'success' => true,
            'message' => 'Liste des utilisateurs',
            'data' => $users
        ]);
    }

    public function loginApi(Request $request)
    {

        
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            $user = User::where('email', $request->email)->first();
            if ($user && Hash::check($request->password, $user->password)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Connexion réussie.',
                    'data' => $user,
                    'token' => $user->createToken('api-token')->plainTextToken
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Identifiants invalides.'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur, ' . $th->getMessage()
            ], 500);
        }
    }
    
    public function register(Request $request) {
        return view('profile.register');
    }
    
    public function store(Request $request) {
        dd($request->all());
        return view('profile.register');
    }

    public function routes(Request $request) {
        if(view()->exists($request->path())) {
            return view($request->path());
        } else {
            return abort(404);
        }
    }

}
