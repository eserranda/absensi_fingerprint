<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataGuru extends Model
{
    use HasFactory;

    protected $fillable =  [
        'nama',
        'nuptk',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'nip',
        'status_pegawai',
        'jenis_ptk',
        'agama',
        'alamat',
    ];

    public function getTanggalLahirAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function roles_guru()
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }
}