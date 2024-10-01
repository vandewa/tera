<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaSidang extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function uttpPesertaSidang() {
        return $this->hasMany(PesertaSidangUttp::class, 'peserta_sidang_id');
    }

}
