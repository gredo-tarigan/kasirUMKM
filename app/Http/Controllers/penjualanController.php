<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\penjualanModel;
use Carbon\Carbon;

class penjualanController extends Controller
{
    public function penjualan()
    {
        return view('kd_penjualan.kd_penjualan',[
            "title" => "Kelola Data Penjualan",
            "name" => "Gredo Tarigan",
            "judul_konten" => "Data Penjualan",
            "data_penjualan" => penjualanModel::all(),
            "carbon_today" => Carbon::today()->isoFormat('dddd, D MMMM Y' )
        ]);
    }

    public function editDataPenjualan(penjualanModel $penjualan_slug)
    {
        return view('kd_penjualan.edit_penjualan', [
            "title" => "Edit Data Penjualan",
            "name" => "Gredo Jack",
            "judul_konten" => "Data Penjualan",
           "penjualan" => $penjualan_slug
        ]);
    }
}
