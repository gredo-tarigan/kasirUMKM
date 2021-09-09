<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    public function kategori_pengeluaran()
    {
        return $this->belongsTo(kategoriPengeluaran::class);
    }
}
