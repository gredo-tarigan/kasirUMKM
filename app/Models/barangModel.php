<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class barangModel extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'nama_barang', 'hargamasuk_barang', 'hargajual_barang', 'stok_barang'];

}
