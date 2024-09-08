<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pengajuan() {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }

    public function standar() {
        return $this->hasMany(PemeriksaanStandar::class, 'pemeriksaan_id');
    }

    public function petugas() {
        return $this->hasMany(PemeriksaanPetugas::class, 'pemeriksaan_id');
    }

    public function berhak() {
        return $this->belongsTo(User::class, 'pegawai_berhak_id' );
    }
    public function penandatangan() {
        return $this->belongsTo(User::class, 'penandatanganan_id');
    }

    public function hasil() {
        return $this->belongsTo(ComCode::class, 'hasil_st');
    }
}
