<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Barang;
use App\Models\kategoriPenjualan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class barangController extends Controller
{
    public function barang()
    {
        return view('kd_barang.kd_barang', [
            "title" => "Kelola Data Barang",
            "judul_konten" => "Data Barang",
            "data_barang" => Barang::all(),
            "carbon_today" => Carbon::today()->isoFormat('dddd, D MMMM Y'),
            "kategori_penjualan" => kategoriPenjualan::all(),          
        ]);
    }

    public function editDataBarang(Barang $barang_slug)
    {
        return view('kd_barang.edit_barang', [
            "title" => "Edit Data Barang",
            "judul_konten" => "Data Barang",
            /*  "barang" => Barang::firstWhere('slug', $slug) */
            /* "barang" => Barang::find($id) */
            "barang" => $barang_slug
        ]);
    }

    //----------------------------------------------------------------------//


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchDataBarang()
    {
        //
        $fetchDataBarang = Barang::all();
        return response()->json([
            'fetchDataBarang' => $fetchDataBarang,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'add_nb' => 'required|max:191',
            'add_hmb' => 'required|numeric|min:3',
            'add_hjb' => 'required|numeric|min:3',
            'add_stob' => 'required|numeric|max:191',
            'add_supb' => 'nullable|max:191',
            'add_kb' => 'nullable|max:191',
            // 'kategori_barang' => 'required|numeric',
            'kategori_penjualan' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $addDataBarang = new Barang; //nama model migrasi database
            $addDataBarang->nama = $request->input('add_nb');
            $addDataBarang->supplier = $request->input('add_supb');
            $addDataBarang->keterangan = $request->input('add_kb');
            $addDataBarang->harga_masuk = $request->input('add_hmb');
            $addDataBarang->harga_jual = $request->input('add_hjb');
            $addDataBarang->stok = $request->input('add_stob');
            $addDataBarang->kategori_penjualan_id = $request->input('kategori_penjualan');
            // $addDataBarang->kategori_barang_id = $request->input('kategori_barang');
            /* $addDataBarang->save();
            return response()->json([
                'status' => 200,
                'message' => 'Data Barang Berhasil Ditambahkan'
            ]); */
            $query = $addDataBarang->save();
            if (!$query) {
                return response()->json([
                    'status' => 200,
                    'code' => 0,
                    'msg' => 'Something went wrong'
                ]);
            } else {
                return response()->json([
                    'code' => 1,
                    'msg' => 'Data Barang Berhasil Ditambahkan'
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $editDataBarang = Barang::find($id);
        if ($editDataBarang) {
            return response()->json([
                'status' => 200,
                'editDataBarang' => $editDataBarang,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Barang Tidak Ditemukan',
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required|max:191',
            'hargamasuk_barang' => 'required|numeric|min:3',
            'hargajual_barang' => 'required|numeric|min:3',
            'stok_barang' => 'required|numeric|max:191',
            'supplier_barang' => 'nullable|max:191',
            'ket_barang' => 'nullable|max:191',
            'kategori_penjualan' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $updateDataBarang = Barang::find($id); //nama model migrasi database
            if ($updateDataBarang) {
                $updateDataBarang->nama = $request->input('nama_barang');
                $updateDataBarang->supplier = $request->input('supplier_barang');
                $updateDataBarang->keterangan = $request->input('ket_barang');
                $updateDataBarang->harga_masuk = $request->input('hargamasuk_barang');
                $updateDataBarang->harga_jual = $request->input('hargajual_barang');
                $updateDataBarang->stok = $request->input('stok_barang');
                $updateDataBarang->kategori_penjualan_id = $request->input('kategori_penjualan');
                $updateDataBarang->update();

                return response()->json([
                    'status' => 200,
                    'message' => 'Data Barang Berhasil Diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data Barang Tidak Ditemukan',
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $deleteDataBarang = Barang::find($id);
        $deleteDataBarang->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data Berhasil Dihapus',
        ]);
    }

    // GET ALL COUNTRIES
    public function getCountriesList()
    {
        $countries = Barang::all();
        return DataTables::of($countries)
            ->addIndexColumn()
            ->addColumn('actions', function($row){
                return '<div style="white-space: nowrap; class="text-center">
                <button id="editBtnBarang" type="button" class="btn btn-primary btn-sm d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalEdit" value="'.$row['id'].'">
                <i class="fa fa-pencil-square-o fa-sm text-white-50"></i>&nbsp;Edit</button>
                <button id="hapusBtnBarang" class="btn btn-danger btn-sm d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalHapus" value="'.$row['id'].'">
                <i class="fa fa-trash-o fa-sm text-white-50"></i>&nbsp;Hapus</button>
                </div>';
            })
            ->addColumn('penjualan', function ($row) {
                return $row->kategori_penjualan->kategori_penjualan;
            })
            ->rawColumns(['actions'])            
            ->make(true);
    }
}
