<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_kelas',
        'id_guru',
        'jumlah_siswa',
    ];

    public function data_guru(): BelongsTo
    {
        return $this->belongsTo(DataGuru::class, 'id_guru', 'id');
    }
}
