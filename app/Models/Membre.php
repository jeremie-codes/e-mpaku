<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    protected $table = 'membres';

    // app/Models/Assujetti.php
    protected $fillable = [
        'cipa',
        'type_assujetti',
        'commune',
        'nom_complet',
        'sexe',
        'nom_responsable',
        'date_naissance',
        'nationalite',
        'activite_principale',
        'lieu_exercice',
        'marche',
        'telephone',
        'email',
        'nif',
        'rccm',
        'affiliation_syndicale',
        'possede_stand',
        'type_bien',
        'profile_photo_path',
    ];


    public function paiement()
    {
        return $this->hasMany(Paiement::class);
    }
}
