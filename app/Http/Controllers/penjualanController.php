<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use Carbon\Carbon;

class penjualanController extends Controller
{
    public function penjualan()
    {
        return view('kd_penjualan.kd_penjualan',[
            "title" => "Kelola Data Penjualan",
            "name" => "Gredo Tarigan",
            "judul_konten" => "Data Penjualan",
            "data_penjualan" => Penjualan::all(),
            "carbon_today" => Carbon::today()->isoFormat('dddd, D MMMM Y' )
        ]);
    }

    public function editDataPenjualan(Penjualan $penjualan_slug)
    {
        return view('kd_penjualan.edit_penjualan', [
            "title" => "Edit Data Penjualan",
            "name" => "Gredo Jack",
            "judul_konten" => "Data Penjualan",
           "penjualan" => $penjualan_slug
        ]);
    }
}
