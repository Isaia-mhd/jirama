<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compteur extends Model
{
    use HasFactory;
    protected $fillable = [
        "code_compteur",
        "user_id",
        "type",
        "pu",
    ];
}
