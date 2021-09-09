<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\tempPenjualan;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class kasirController extends Controller
{
    // 
    public function kasir()
    {
        return view('kasir.kasir',[
            "title" => "Kasir",
            "name" => "Tarigan Jack",
            "judul_konten" => "Tarigan Jack",
            "carbon_today" => Carbon::today(),
            "total_pembelian" => tempPenjualan::sum('sub_total'),
            "option_select" => Barang::all()
        ]);
    }

    public function getTempPenjualanList()
    {
        $countries = tempPenjualan::all();
        //$countries = 'App\Models\tempPenjualan'::with('kategori_penjualan')->select('temp_penjualans.*')->latest();
        return DataTables::of($countries)
            ->addIndexColumn()
            ->addColumn('percobaan', function($row){
                return $row->kategori_penjualan->nama;
            })
            ->addColumn('percobaan2', function($row){
                return $row->barang->nama;
            })
            ->addColumn('actions', function ($row) {
                return '<div style="white-space: nowrap; class="text-center">
                <button id="editBtnTempPengeluaran" type="button" class="btn btn-primary btn-sm d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalEdit" value="' . $row['id'] . '">
                <i class="fa fa-pencil-square-o fa-sm text-white-50"></i>&nbsp;Edit</button>
                <button id="hapusBtnTempPengeluaran" class="btn btn-danger btn-sm d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalHapus" value="' . $row['id'] . '">
                <i class="fa fa-trash-o fa-sm text-white-50"></i>&nbsp;Hapus</button>
                </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }
}