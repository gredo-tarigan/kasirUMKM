<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tempPenjualan extends Model
{
    use HasFactory;

    protected $guarded = ['id']; 
    public function kategori_penjualan()
    {
        return $this->belongsTo(kategoriPenjualan::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function relasi_nota()
    {
        return $this->belongsTo(nota::class, 'id');
    }

    
}
