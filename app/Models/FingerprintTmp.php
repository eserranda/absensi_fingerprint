<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FingerprintTmp extends Model
{
    use HasFactory;

    protected $fillable = [
        'apiKey',
        'id_finger'
    ];
}