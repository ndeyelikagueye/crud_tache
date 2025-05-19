<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taches extends Model
{
    public $fillable = [
        'titre',
        'description',
        'photo',
    ];
}
