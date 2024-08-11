<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{

    protected $fillable = [
        'semester',
        'tahun_ajaran'
    ];

    use HasFactory;
}
