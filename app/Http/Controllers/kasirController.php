<?php

namespace App\Http\Controllers;

use App\Models\kasirModel;
use App\Models\barangModel;

use Illuminate\Http\Request;
use Carbon\Carbon;

class kasirController extends Controller
{
    // 
    public function kasir()
    {
        return view('kasir.kasir',[
            "title" => "Kasir",
            "name" => "Tarigan Jack",
            "judul_konten" => "Tarigan Jack",
            "data_barang" => barangModel::all(),
            "carbon_today" => Carbon::today()
        ]);
    }
}