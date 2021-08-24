<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barangModel;

class barangController extends Controller
{
    public function barang()
    {
        return view('kd_barang.kd_barang',[
            "title" => "Kelola Data Barang",
            "name" => "Gredo Jack",
            "judul_konten" => "Data Barang",
            "data_barang" => barangModel::all()
        ]);
    }

    public function editDataBarang(barangModel $barang_slug)
    {
        return view('kd_barang.edit_barang', [
            "title" => "Edit Data Barang",
            "name" => "Gredo Jack",
            "judul_konten" => "Data Barang",
           /*  "barang" => barangModel::firstWhere('slug', $slug) */
           /* "barang" => barangModel::find($id) */
           "barang" => $barang_slug
        ]);
    }
}
