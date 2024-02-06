<?php

namespace App\Models;

use App\Models\DataGuru;
use App\Models\Fingerprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FingerprintGuru extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_guru',
        'id_modul_fingerprint',
        'id_fingerprint'
    ];

    public function guru(): BelongsTo
    {
        return $this->belongsTo(DataGuru::class, 'id_guru', 'id');
    }
    public function modul_fingerprint(): BelongsTo
    {
        return $this->belongsTo(Fingerprint::class, 'id_modul_fingerprint', 'id');
    }
}
