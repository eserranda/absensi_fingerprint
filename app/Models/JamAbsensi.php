<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JamAbsensi extends Model
{
    use HasFactory;
    protected $fillable = [
        'hari',
        'jam_masuk',
        'jam_pulang',
    ];
}
