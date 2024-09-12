<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uttp extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeCari($filter, $value)
    {
        if ($value) {
            return $this->where('nama', 'like', "%$value%");
        }
    }

    public function pengajuan()
    {
        return $this->hasMany(PengajuanUttp::class, 'uttp_id');
    }
}
