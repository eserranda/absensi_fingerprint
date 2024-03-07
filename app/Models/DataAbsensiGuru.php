<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataAbsensiGuru extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_guru',
        'id_fingerprint',
        'tanggal_absen',
        'jam_masuk',
        'jam_keluar',
        'keterangan',

    ];

    public function guru(): BelongsTo
    {
        return $this->belongsTo(DataGuru::class, 'id_guru', 'id');
    }

    public function id_fingerprint(): BelongsTo
    {
        return $this->belongsTo(FingerprintGuru::class, 'id_guru', 'id');
    }
}
