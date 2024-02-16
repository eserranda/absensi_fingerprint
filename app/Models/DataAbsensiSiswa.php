<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataAbsensiSiswa extends Model
{
    use HasFactory;

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(DataSiswa::class, 'id_siswa', 'id');
    }
}
