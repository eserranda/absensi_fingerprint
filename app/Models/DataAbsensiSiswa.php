<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataAbsensiSiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_siswa',
        'id_fingerprint',
        'kelas',
        'tanggal_absen',
        'jam_masuk',
        'jam_keluar',
        'keterangan',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(DataSiswa::class, 'id_siswa', 'id');
    }
}
