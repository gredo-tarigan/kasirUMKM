<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nota extends Model
{
    use HasFactory;

    public function relasi_tempPenjualan()
    {
        return $this->hasMany('App\Models\tempPenjualan'::class);
    }
}
