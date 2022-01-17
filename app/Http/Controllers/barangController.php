<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Barang;
use App\Models\StockOpname;
use Illuminate\Http\Request;
use App\Models\kategoriPenjualan;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class barangController extends Controller
{
    public function barang(Request $request)
    {
        /*  if (request()->ajax()) {
            if (!empty($request->tanggal_dipilih)) {
                $data = DB::table('stock_opnames')
                    ->where(
                        'opname_date',
                        array($request->tanggal_dipilih)
                    )
                    ->get();
            } else {
                $data = DB::table('stock_opnames')
                    ->get();
            }
            return datatables()->of($data)->addIndexColumn()->make(true);
        } */
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
            ->addColumn('actions', function ($row) {
                return '<div style="white-space: nowrap; class="text-center">
                <button id="editBtnBarang" type="button" class="btn btn-primary btn-sm d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalEdit" value="' . $row['id'] . '">
                <i class="fa fa-pencil-square-o fa-sm text-white-50"></i>&nbsp;Edit</button>
                <button id="hapusBtnBarang" class="btn btn-danger btn-sm d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalHapus" value="' . $row['id'] . '">
                <i class="fa fa-trash-o fa-sm text-white-50"></i>&nbsp;Hapus</button>
                </div>';
            })
            ->addColumn('penjualan', function ($row) {
                return $row->kategori_penjualan->kategori_penjualan;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function getTabelStockOpname(Request $request)
    {
        if (request()->ajax()) {
            if (!empty($request->tanggal_dipilih)) {
                $data = StockOpname::latest()->where(
                    'opname_date',
                    array($request->tanggal_dipilih)
                )
                    ->get();
            } else {
                $data = StockOpname::latest()->get();
            }
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('actions', function ($row) {
                    return '<div style="white-space: nowrap; class="text-center">
                    <button id="editBtnOpname" type="button" class="btn btn-primary btn-sm d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalOpnameEdit" value="' . $row['id'] . '">
                    <i class="fa fa-pencil-square-o fa-sm text-white-50"></i></button>

                <button id="hapusBtnOpname" class="btn btn-danger btn-sm d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalOpnameHapus" value="' . $row['id'] . '">
                <i class="fa fa-trash-o fa-sm text-white-50"></i></button>
                </div>';
                })
                ->addColumn('nama_barang', function ($row) {
                    return $row->barang->nama;
                })
                ->addColumn('kategori_barang', function ($row) {
                    return $row->barang->kategori_penjualan->kategori_penjualan;
                })
                ->addColumn('updated_at', function ($row) {
                    return $row->updated_at->format('Y-m-d');
                })
                ->addColumn('opname_date', function ($row) {
                    return $row->opname_date;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }

    public function postDataStockOpname(Request $request)
    {
        //
        $validator = Validator::make(
            $request->all(),
            [
                'AddDO_Tanggal' => 'required',
                // 'AddDO_IdBarang' => 'required|numeric',
                'AddDO_IdBarang' => 'required|numeric|unique:App\Models\StockOpname,barang_id,NULL,id,opname_date,' . $request->AddDO_Tanggal,
                'AddDO_StokSistem' => 'required|numeric',
                'AddDO_StokFisik' => 'required|numeric',
                'AddDO_StokMasuk' => 'required|numeric',
                'AddDO_StokAwal' => 'required|numeric',
            ],
            ['AddDO_IdBarang.unique' => 'Data Opname Barang Ini Telah Ada']
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $addDataOpname = new StockOpname; //nama model migrasi database
            $addDataOpname->opname_date = $request->input('AddDO_Tanggal');
            $addDataOpname->barang_id = $request->input('AddDO_IdBarang');
            $addDataOpname->stok_sistem = $request->input('AddDO_StokSistem');
            $addDataOpname->stok_fisik = $request->input('AddDO_StokFisik');
            $addDataOpname->stok_masuk = $request->input('AddDO_StokMasuk');
            $addDataOpname->stok_awal = $request->input('AddDO_StokAwal');
            $query = $addDataOpname->save();
            if (!$query) {
                return response()->json([
                    'status' => 200,
                    'code' => 0,
                    'msg' => 'Something went wrong'
                ]);
            } else {
                return response()->json([
                    'code' => 1,
                    'msg' => 'Data Opname Berhasil Ditambahkan'
                ]);
            }
        }
    }

    public function updateStockBarangOpname(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'AddDO_StokAwalKeDB' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $updateDataStokBarang = Barang::find($id); //nama model migrasi database
            if ($updateDataStokBarang) {
                $updateDataStokBarang->stok_awal = $request->input('AddDO_StokAwalKeDB');
                $updateDataStokBarang->stok = $request->input('AddDO_StokAwalKeDB');
                $updateDataStokBarang->update();

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

    public function editDataOpname($id)
    {
        //
        $EditDataOpname = StockOpname::with('barang.kategori_penjualan')->find($id);
        if ($EditDataOpname) {
            return response()->json([
                'status' => 200,
                'EditDataOpname' => $EditDataOpname,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Opname Tidak Ditemukan',
            ]);
        }
    }

    public function updateDataOpname(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'stok_fisik' => 'required | numeric',
            'stok_masuk' => 'required | numeric',
            'stok_awal' => 'nullable',
            'stok_sistem' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $updateDataOpname = StockOpname::find($id); //nama model migrasi database
            if ($updateDataOpname) {
                $updateDataOpname->stok_fisik = $request->input('stok_fisik');
                $updateDataOpname->stok_masuk = $request->input('stok_masuk');
                if ($request->input('stok_awal')) {
                    $updateDataOpname->stok_awal = $request->input('stok_awal');
                }
                if ($request->input('stok_sistem')) {
                    $updateDataOpname->stok_sistem = $request->input('stok_sistem');
                }
                $updateDataOpname->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'Data Opname Berhasil Diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data Opname Tidak Ditemukan',
                ]);
            }
        }
    }

    public function updateEditStockBarangOpname(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'EditStockAwal' => 'required|numeric',
            'EditStockSistem' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $updateEditDataStokBarang = Barang::find($id); //nama model migrasi database
            if ($updateEditDataStokBarang) {
                $updateEditDataStokBarang->stok_awal = $request->input('EditStockAwal');
                $updateEditDataStokBarang->stok = $request->input('EditStockSistem');
                $updateEditDataStokBarang->update();

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

    public function HapusDataOpname($id)
    {
        //
        $deleteDataOpname = StockOpname::find($id);
        $deleteDataOpname->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data Berhasil Dihapus',
        ]);
    }
    /* public function passingStokAwal($id) //passing untuk stok awal tetap server side
    {
        //
        $passingStokAwal = Barang::find($id);
        if ($passingStokAwal) {
            return response()->json([
                'status' => 200,
                'editSettingsAkun' => $editSettingsAkun,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Akun Tidak Ditemukan',
            ]);
        }
    } */
}
