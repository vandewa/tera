<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTera extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function peralatans()
    {
        return $this->hasMany(JadwalTeraPeralatan::class);
    }

    public function petugas()
    {
        return $this->hasMany(JadwalTeraPetugas::class);
    }

    public function scopeCari($filter, $value)
    {
        if ($value) {
            return $this->where('lokasi', 'like', "%$value%");
        }
    }

    public function status()
    {
        return $this->belongsTo(ComCode::class, 'jadwal_tera_st');
    }
}
