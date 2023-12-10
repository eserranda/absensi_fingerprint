<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JadwalPelajaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'hari',
        'matpel',
        'jam_mulai',
        'jam_selesai',
        'id_guru',
        'kelas',
        'ruangan',
    ];

    public function data_guru(): BelongsTo
    {
        return $this->belongsTo(DataGuru::class, 'id_guru', 'id');
    }
    // public function data_guru(): HasMany
    // {
    //     return $this->hasMany(DataGuru::class, 'id', 'id_guru');
    //     // return $this->hasbelongsTo(DataGuru::class, 'id_guru', 'id');
    // }
}