<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EauReleve extends Model
{
    use HasFactory;

    protected $fillable = [
        "compteur_id",
        "valeur",
        "date_releve",
        "date_presentation",
        "date_limite"
    ];

    public function compteur(): BelongsTo
    {
        return $this->belongsTo(Compteur::class);
    }
}
