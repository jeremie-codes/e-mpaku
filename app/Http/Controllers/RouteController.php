<?php

namespace App\Http\Controllers;

use App\Models\Membre;
use App\Models\Paiement;
use App\Models\User;
use Illuminate\Http\Request;

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
