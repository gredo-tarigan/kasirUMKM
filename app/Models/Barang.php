<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    //protected  $table = 'barang_models';
    protected $guarded = [ 'id']; 

    public function kategori_barang()
    {
        return $this->belongsTo(kategoriBarang::class);
    }

    public function kategori_penjualan()
    {
        return $this->belongsTo(kategoriPenjualan::class);
    }

    public function relasi_barang_temp()
    {
        return $this->hasMany('App\Models\tempPenjualan'::class);
    }
}
