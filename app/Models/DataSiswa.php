<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataSiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nisn',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'kelas',
        'alamat',
    ];


    public function getTanggalLahirAttribute($value)
    {
        return Carbon::parse($value);
    }
}
