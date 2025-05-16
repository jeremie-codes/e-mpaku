<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membre extends Model
{
    protected $table = 'membres';

    protected $fillable = [
        'ref',
        'sec_ref',
        'firstname',
        'lastname',
        'commune',
        'profile_photo_path',
    ];

    public function paiement()
    {
        return $this->hasMany(Paiement::class);
    }
}
