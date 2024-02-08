<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FingerprintSiswa extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_siswa',
        'id_modul_fingerprint',
        'id_fingerprint'
    ];
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(DataSiswa::class, 'id_siswa', 'id');
    }

    public function modul_fingerprint(): BelongsTo
    {
        return $this->belongsTo(FingerprintModul::class, 'id_modul_fingerprint', 'id');
    }
}