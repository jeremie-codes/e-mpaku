<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Paiement extends Model
{
    protected $table = 'paiements';

    protected $fillable = [
        'membre_id',
        'montant'
    ];

    public function membre(): BelongsTo
    {
        return $this->belongsTo(Membre::class);
    }
}
