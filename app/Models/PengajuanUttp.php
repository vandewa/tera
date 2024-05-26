<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanUttp extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function uttp() {
        return $this->belongsTo(Uttp::class, 'uttp_id');
    }
}
