<?php

namespace App\Http\Controllers;

use App\Models\AkunModel;
use App\Models\akunModel as ModelsAkunModel;
use Illuminate\Http\Request;

use Carbon\Carbon;

class akunController extends Controller
{
    public function index()
    {
        return view('kd_akun.kd_akun',[
            "title" => "Kelola Akun",
            "name" => "Obed Jack",
            "judul_konten" => "Data Akun",
            "data_akun_sementara" => akunModel::all(),
        ]);
    }

    public function editDataAkun($username)
    {
        return view('kd_akun.edit_akun', [
            "title" => "Edit Data Akun",
            "name" => "Gredo Jack",
            "judul_konten" => "Data Akun",
            "new_data" => akunModel::firstWhere('username', $username)
            
        ]);
    }
}