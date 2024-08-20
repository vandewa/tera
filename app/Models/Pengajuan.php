<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function uttpItem()
    {
        return $this->hasMany(PengajuanUttp::class, 'pengajuan_id');
    }

    public function jenisPengajuan()
    {
        return $this->belongsTo(ComCode::class, 'pengajuan_tp');
    }
    public function statusPengajuan()
    {
        return $this->belongsTo(ComCode::class, 'pengajuan_st');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function jadwal()
    {
        return $this->belongsTo(JadwalTera::class, 'jadwal_tera_id');
    }
}
