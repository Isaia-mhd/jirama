<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Compteur extends Model
{
    use HasFactory;
    protected $fillable = [
        "code_compteur",
        "user_id",
        "type",
        "pu",
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function eauReleve(): HasMany
    {
        return $this->hasMany(EauReleve::class);
    }
}
