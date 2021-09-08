<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barangModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class barangController extends Controller
{
    public function barang()
    {
        return view('kd_barang.kd_barang', [
            "title" => "Kelola Data Barang",
            "name" => "Gredo Jack",
            "judul_konten" => "Data Barang",
            "data_barang" => barangModel::all(),
            "carbon_today" => Carbon::today()->isoFormat('dddd, D MMMM Y')


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

    //----------------------------------------------------------------------//


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchDataBarang()
    {
        //
        $fetchDataBarang = barangModel::all();
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
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $addDataBarang = new barangModel; //nama model migrasi database
            $addDataBarang->nama_barang = $request->input('add_nb');
            $addDataBarang->supplier_barang = $request->input('add_supb');
            $addDataBarang->ket_barang = $request->input('add_kb');
            $addDataBarang->hargamasuk_barang = $request->input('add_hmb');
            $addDataBarang->hargajual_barang = $request->input('add_hjb');
            $addDataBarang->stok_barang = $request->input('add_stob');
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
        $editDataBarang = barangModel::find($id);
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
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $updateDataBarang = barangModel::find($id); //nama model migrasi database
            if ($updateDataBarang) {
                $updateDataBarang->nama_barang = $request->input('nama_barang');
                $updateDataBarang->supplier_barang = $request->input('supplier_barang');
                $updateDataBarang->ket_barang = $request->input('ket_barang');
                $updateDataBarang->hargamasuk_barang = $request->input('hargamasuk_barang');
                $updateDataBarang->hargajual_barang = $request->input('hargajual_barang');
                $updateDataBarang->stok_barang = $request->input('stok_barang');
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
        $deleteDataBarang = barangModel::find($id);
        $deleteDataBarang->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data Berhasil Dihapus',
        ]);
    }

    // GET ALL COUNTRIES
    public function getCountriesList()
    {
        $countries = barangModel::all();
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
            ->rawColumns(['actions'])
            
            ->make(true);
    }
}
