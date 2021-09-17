<?php

namespace App\Http\Controllers;

use App\Models\nota;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;


class penjualanController extends Controller
{
    public function penjualan()
    {
        return view('kd_penjualan.kd_penjualan',[
            "title" => "Kelola Data Penjualan",
            "judul_konten" => "Data Penjualan",
            "carbon_today" => Carbon::today()->isoFormat('dddd, D MMMM Y' )
        ]);
    }

    // ---------------------------------- //
    public function getPenjualanList()
    {
        $countries = nota::all();
        return DataTables::of($countries)
            ->addIndexColumn()
            ->addColumn('actions', function($row){
                return '<div style="white-space: nowrap; class="text-center">
                <button id="editBtnPenjualan" type="button" class="btn btn-primary btn-sm d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalEdit" value="'.$row['id'].'">
                <i class="fa fa-pencil-square-o fa-sm text-white-50"></i>&nbsp;Edit</button>
                <button id="hapusBtnPenjualan" class="btn btn-danger btn-sm d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalHapus" value="'.$row['id'].'">
                <i class="fa fa-trash-o fa-sm text-white-50"></i>&nbsp;Hapus</button>
                </div>';
            })
            ->addColumn('total', function ($row){
                return $row->relasi_tempPenjualan->sum('sub_total');
            })
            ->rawColumns(['actions'])
            
            ->make(true);
    }

    public function edit($id)
    {
        //

    }
}
