<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barangModel extends Model
{
    use HasFactory;

    protected  $table = 'barang_models';
    protected $fillable = [
        'nama_barang', 
        'hargamasuk_barang', 
        'hargajual_barang', 
        'stok_barang', 
        'supplier_barang',
        'kategori_barang',
        'kategorijual_barang', 
        'ket_barang']; 
}
