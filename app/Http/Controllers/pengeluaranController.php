<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pengeluaranModel;

class pengeluaranController extends Controller
{
    public function pengeluaran()
    {
    return view('kd_pengeluaran.kd_pengeluaran',[
        "title" => "Kelola Data Pengeluaran",
        "name" => "Tarigan Jack",
        "judul_konten" => "Data Pengeluaran",
        "data_pengeluaran" => pengeluaranModel::all()
    ]);
    }

    public function editDataPengeluaran(pengeluaranModel $pengeluaran_slug)
    {
        return view('kd_pengeluaran.edit_pengeluaran', [
            "title" => "Edit Data Pengeluaran",
            "name" => "Gredo Jack",
            "judul_konten" => "Data Pengeluaran",
           "pengeluaran" => $pengeluaran_slug
        ]);
    }
}
