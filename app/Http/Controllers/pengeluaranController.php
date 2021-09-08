<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pengeluaranModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class pengeluaranController extends Controller
{
    public function pengeluaran()
    {
        return view('kd_pengeluaran.kd_pengeluaran', [
            "title" => "Kelola Data Pengeluaran",
            "name" => "Tarigan Jack",
            "judul_konten" => "Data Pengeluaran",
            "data_pengeluaran" => pengeluaranModel::all(),
            "carbon_today" => Carbon::today()->isoFormat('dddd, D MMM Y')
        ]);
    }


    // GET ALL PENGELUARAN
    public function getPengeluaranList()
    {
        $countries = pengeluaranModel::all();
        return DataTables::of($countries)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div style="white-space: nowrap; class="text-center">
                <button id="editBtnPengeluaran" type="button" class="btn btn-primary btn-sm d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalEdit" value="' . $row['id'] . '">
                <i class="fa fa-pencil-square-o fa-sm text-white-50"></i>&nbsp;Edit</button>
                <button id="hapusBtnPengeluaran" class="btn btn-danger btn-sm d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalHapus" value="' . $row['id'] . '">
                <i class="fa fa-trash-o fa-sm text-white-50"></i>&nbsp;Hapus</button>
                </div>';
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function destroy($id)
    {
        //
        $deleteDataPengeluaran = pengeluaranModel::find($id);
        $deleteDataPengeluaran->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data Berhasil Dihapus',
        ]);
    }

    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'add_np' => 'required',
            'add_nomp' => 'required|numeric|min:3',
            'add_kp' => 'required',
            'add_katp' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $addDataPengeluaran = new pengeluaranModel; //nama model migrasi database
            $addDataPengeluaran->nama_pengeluaran = $request->input('add_np');
            $addDataPengeluaran->nominal_pengeluaran = $request->input('add_nomp');
            $addDataPengeluaran->ket_pengeluaran = $request->input('add_kp');
            $addDataPengeluaran->kategori_pengeluaran = $request->input('add_katp');
            /* $addDataBarang->save();
            return response()->json([
                'status' => 200,
                'message' => 'Data Barang Berhasil Ditambahkan'
            ]); */
            $query = $addDataPengeluaran->save();
            if (!$query) {
                return response()->json([
                    'status' => 200,
                    'code' => 0,
                    'msg' => 'Something went wrong'
                ]);
            } else {
                return response()->json([
                    'code' => 1,
                    'msg' => 'Data Pengeluaran Berhasil Ditambahkan'
                ]);
            }
        }
    }

    public function edit($id)
    {
        //
        $editDataPengeluaran = pengeluaranModel::find($id);
        if ($editDataPengeluaran) {
            return response()->json([
                'status' => 200,
                'editDataPengeluaran' => $editDataPengeluaran,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Pengeluaran Tidak Ditemukan',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'nama_pengeluaran' => 'required',
            'nominal_pengeluaran' => 'required|numeric|min:3',
            'ket_pengeluaran' => 'required',
            'kategori_pengeluaran' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $updateDataPengeluaran = pengeluaranModel::find($id); //nama model migrasi database
            if ($updateDataPengeluaran) {
                $updateDataPengeluaran->nama_pengeluaran = $request->input('nama_pengeluaran');
                $updateDataPengeluaran->nominal_pengeluaran = $request->input('nominal_pengeluaran');
                $updateDataPengeluaran->ket_pengeluaran = $request->input('ket_pengeluaran');
                $updateDataPengeluaran->kategori_pengeluaran = $request->input('kategori_pengeluaran');
                $updateDataPengeluaran->update();

                return response()->json([
                    'status' => 200,
                    'message' => 'Data Pengeluaran Berhasil Diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data Pengeluaran Tidak Ditemukan',
                ]);
            }
        }
    }
}
