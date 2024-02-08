<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FingerprintModul extends Model
{
    use HasFactory;
    protected $fillable = [
        'modul_fingerprint',
        'apiKey',
        'status'
    ];
}