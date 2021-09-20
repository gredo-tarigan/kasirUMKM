<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class pengeluaranController extends Controller
{
    public function pengeluaran()
    {
        return view('kd_pengeluaran.kd_pengeluaran', [
            "title" => "Kelola Data Pengeluaran",
            "judul_konten" => "Data Pengeluaran",
            "data_pengeluaran" => Pengeluaran::all(),
            "carbon_today" => Carbon::today()->isoFormat('dddd, D MMM Y')
        ]);
    }


    // GET ALL PENGELUARAN
    public function getPengeluaranList()
    {
        $countries = Pengeluaran::all();
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
     /*        ->editColumn('created_at', function ($row) {
                return $row->created_at->format('Y-m-d'); // human readable format
            }) */
            ->editColumn('created_at', function ($row) {
                return $row->created_at->format('Y-m-d'); // human readable format
            })
            ->make(true);
    }

    public function destroy($id)
    {
        //
        $deleteDataPengeluaran = Pengeluaran::find($id);
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
            'add_katp' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $addDataPengeluaran = new Pengeluaran(); //nama model migrasi database
            $addDataPengeluaran->nama = $request->input('add_np');
            $addDataPengeluaran->nominal = $request->input('add_nomp');
            $addDataPengeluaran->keterangan = $request->input('add_kp');
            $addDataPengeluaran->kategori_pengeluaran_id = $request->input('add_katp');
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
        $editDataPengeluaran = Pengeluaran::find($id);
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
            'kategori_pengeluaran' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $updateDataPengeluaran = Pengeluaran::find($id); //nama model migrasi database
            if ($updateDataPengeluaran) {
                $updateDataPengeluaran->nama = $request->input('nama_pengeluaran');
                $updateDataPengeluaran->nominal = $request->input('nominal_pengeluaran');
                $updateDataPengeluaran->keterangan = $request->input('ket_pengeluaran');
                $updateDataPengeluaran->kategori_pengeluaran_id = $request->input('kategori_pengeluaran');
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
