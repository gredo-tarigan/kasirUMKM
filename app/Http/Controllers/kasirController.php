<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\tempPenjualan;
use App\Models\nota;


use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;
use App\Models\kategoriBarang;
use Illuminate\Support\Facades\DB;

class kasirController extends Controller
{
    // 
    public function kasir()
    {

        return view('kasir.kasir', [
            "title" => "Kasir",
            "judul_konten" => "Tarigan Jack",
            "carbon_today" => Carbon::today(),
            "option_select" => Barang::all(),
            "woy" => kategoriBarang::all(),
        ]);
    }

    public function passNoNota(){
        $carbon_today = Carbon::today()->isoFormat('DMMYY');
        $a = nota::whereDate('created_at', Carbon::today());       
        $b = $a->count() + 1;
        $nota_hari_ini = str_pad($b, 3, '0', STR_PAD_LEFT);
        return response()->json([
            'test' => $nota_hari_ini,
            'carbon_today' => $carbon_today
        ]);
    }

    public function passIdNota()
    {
        $idNota_terakhir = nota::max('id') + 1;
        /* $a = kategoriBarang::max('id') + 1;
        $countries = tempPenjualan::where('barang_id', '<', $a); */
        return response()->json($idNota_terakhir);
    }

    public function getTempPenjualanList()
    {

        $idNota_terakhir = nota::max('id') + 1;
        $tampilan_kasir = tempPenjualan::where('nota_id', '=', $idNota_terakhir);
        //$countries = tempPenjualan::whereNull('nota.id');
        //$countries = 'App\Models\tempPenjualan'::with('kategori_penjualan')->select('temp_penjualans.*')->latest();
        return DataTables::of($tampilan_kasir)
            ->addIndexColumn()
            ->addColumn('percobaan', function ($row) {
                return $row->kategori_penjualan->nama;
            })
            ->addColumn('percobaan2', function ($row) {
                return $row->barang->nama;
            })
            ->addColumn('actions', function ($row) {
                return '<div style="white-space: nowrap; class="text-center">
                <button id="hapusBtnTempPengeluaran" class="btn btn-danger btn-sm d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalHapus" value="' . $row['id'] . '">
                <i class="fa fa-trash-o fa-sm text-white-50"></i>&nbsp;Hapus</button>
                </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'add_idBarang' => 'required|numeric',
            'add_hargaJadi' => 'required|numeric', //make nama tabel bukan nama model //validasi unique
            'add_massaPieces' => 'required|numeric',
            'add_penjualanId' => 'required|numeric',
            'add_akunId' => 'required|numeric',
            'add_subTotal' => 'required|numeric',
            'add_notaId' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $addDataTempPenjualan = new tempPenjualan(); //nama model migrasi database
            $addDataTempPenjualan->barang_id = $request->input('add_idBarang');
            //$addDataTempPenjualan->harga_jadi = $request->input('add_hargaJadi');
            $addDataTempPenjualan->harga_jadi =  $request->input('add_hargaJadi');
            $addDataTempPenjualan->massa_pieces = $request->input('add_massaPieces');
            $addDataTempPenjualan->kategori_penjualan_id = $request->input('add_penjualanId');
            $addDataTempPenjualan->akun_id = $request->input('add_akunId');
            $addDataTempPenjualan->sub_total = $request->input('add_subTotal');
            $addDataTempPenjualan->nota_id = $request->input('add_notaId');
            $query = $addDataTempPenjualan->save();
            if (!$query) {


                return response()->json([
                    'status' => 200,
                    'code' => 0,
                    'msg' => 'Something went wrong'
                ]);
            } else {
                return response()->json([
                    'code' => 1,
                    'msg' => 'Data Pembelian Berhasil Ditambahkan'
                ]);
            }
        }
    }

    public function storeNota(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'add_noNota' => 'required',
            'add_namaPembeli' => '',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $addDataNota = new nota(); //nama model migrasi database
            $addDataNota->nomor_nota = $request->input('add_noNota');
            $addDataNota->nama = $request->input('add_namaPembeli');
            $query = $addDataNota->save();
            if (!$query) {
                return response()->json([
                    'status' => 200,
                    'code' => 0,
                    'msg' => 'Something went wrong'
                ]);
            } else {
                return response()->json([
                    'code' => 1,
                    'msg' => 'Data Nota Berhasil Ditambahkan'
                ]);
            }
        }
    }

    public function destroy($id)
    {
        //
        $deleteDataTempPenjualan = tempPenjualan::find($id);
        $deleteDataTempPenjualan->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data Berhasil Dihapus',
        ]);
    }
}
