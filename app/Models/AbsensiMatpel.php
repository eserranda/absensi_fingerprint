<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AbsensiMatpel extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'hari',
        'id_siswa',
        'kelas',
        'id_guru',
        'id_matpel',
        'keterangan',
    ];

    public function guru(): BelongsTo
    {
        return $this->belongsTo(DataGuru::class, 'id_guru', 'id');
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(DataSiswa::class, 'id_siswa', 'id');
    }

    public function matpel(): BelongsTo
    {
        return $this->belongsTo(Matpel::class, 'id_matpel', 'id');
    }
}