<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Akun extends \Illuminate\Foundation\Auth\User
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kategori_akun()
    {
        return $this->belongsTo(kategoriAkun::class, 'kategori_akun_id');
    }
}
