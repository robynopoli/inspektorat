<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'username', 'nip');
    }

    public function obriks(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Obrik::class, 'pegawai_with_obriks');
//        return $this->belongsToMany(Obrik::class, 'pegawai_with_obriks', 'kode_bidang_obrik', 'kode_bidang_obrik');
    }
}
