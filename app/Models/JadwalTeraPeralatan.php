<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTeraPeralatan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function jadwal()
    {
        return $this->belongsTo(JadwalTera::class, 'jadwal_tera_id');
    }

    public function peralatan()
    {
        return $this->belongsTo(Peralatan::class, 'peralatan_id');
    }
}
