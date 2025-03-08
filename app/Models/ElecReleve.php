<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElecReleve extends Model
{
    use HasFactory;
    protected $fillable = [
        "compteur_id",
        "valeur",
        "date_releve",
        "date_presentation",
        "date_limite"
    ];
}
