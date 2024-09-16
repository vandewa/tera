<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UttpUser extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function uttp()
    {
        return $this->belongsTo(Uttp::class, 'uttp_id');
    }


    public function scopeCari($filter, $value)
    {
        if ($value) {
            return $this->where('nama', 'like', "%$value%");
        }
    }

}
