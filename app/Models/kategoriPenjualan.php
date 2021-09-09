<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategoriPenjualan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function relasi_penjualan_temp()
    {
        return $this->hasMany('App\Models\tempPenjualan'::class);
    }
}
