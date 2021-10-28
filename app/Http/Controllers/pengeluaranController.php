<?php

namespace App\Http\Controllers;

use App\Models\kategoriPengeluaran;
use Carbon\Carbon;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            "kategori_pengeluaran" => kategoriPengeluaran::all(),
            "carbon_today" => Carbon::today()->isoFormat('dddd, D MMM Y')
        ]);
    }


    // GET ALL PENGELUARAN
    public function getPengeluaranList()
    {
        $countries = Pengeluaran::latest();
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

            ->editColumn('created_at', function ($row) {
                 return $row->created_at->format('d-M-Y'); // human readable format
             })
            ->editColumn('nominal', function ($row) {
                 return $row->nominal; // human readable format
             })
             ->editColumn('kategori_pengeluaran_id', function ($row) {
                 return $row->kategori_pengeluaran->kategori_pengeluaran;
             })
            ->make(true);
    }

    public function getPengeluaranLaporan()
    {
        $countries = Pengeluaran::latest()->select(
            "id" , "nama_pengeluaran", "kategori_pengeluaran_id", "keterangan",
            DB::raw("(sum(nominal)) as total_click"),
            DB::raw("(DATE_FORMAT(created_at, '%M %Y')) as my_year")
            )
            ->orderBy('created_at')
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%M %Y')"))
            ->groupBy(DB::raw('kategori_pengeluaran_id'))->get();
        return DataTables::of($countries)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div style="white-space: nowrap;" class="text-center">
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
                 return $row->my_year; // human readable format
             })
            ->editColumn('nominal', function ($row) {
                 return $row->total_click; // human readable format
             })
             ->editColumn('kategoriPengeluaran', function ($row) {
                 return $row->kategori_pengeluaran->kategori_pengeluaran;
             })
            ->make(true);
    }

    public function getJenisPengeluaranTabel ()
    {
        $countries = kategoriPengeluaran::latest();
        return DataTables::of($countries)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                return '<div style="white-space: nowrap;" class="text-center">
                <button id="editBtnJenisPengeluaran" type="button" class="btn btn-primary btn-sm d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalEdit2" value="' . $row['id'] . '">
                <i class="fa fa-pencil-square-o fa-sm text-white-50"></i></button>

                <button id="hapusBtnJenisPengeluaran" class="btn btn-danger btn-sm d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalHapus2" value="' . $row['id'] . '">
                <i class="fa fa-trash-o fa-sm text-white-50"></i></button>
                </div>';
            })
            ->rawColumns(['actions'])
            ->editColumn('kategori', function ($row) {
                 return $row->kategori_pengeluaran;
             })
            ->make(true);
    }

    public function destroy_jenisPengeluaran($id)
    {
        //
        $deleteJenisPengeluaran = kategoriPengeluaran::find($id);
        $deleteJenisPengeluaran->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Jenis Pengeluaran Berhasil Dihapus',
        ]);
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
            $addDataPengeluaran->nama_pengeluaran = $request->input('add_np');
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

    public function storeJenisPengeluaran(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'add_jenis_pengeluaran' => 'required|unique:kategori_pengeluarans,kategori_pengeluaran,', //make nama tabel bukan nama model //validasi unique
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $addJenisPengeluaran = new kategoriPengeluaran(); //nama model migrasi database
            $addJenisPengeluaran->kategori_pengeluaran = $request->input('add_jenis_pengeluaran');
            $query = $addJenisPengeluaran->save();
            if (!$query) {
                return response()->json([
                    'status' => 200,
                    'code' => 0,
                    'msg' => 'Something went wrong'
                ]);
            } else {
                return response()->json([
                    'code' => 1,
                    'msg' => 'Jenis Pengeluaran Berhasil Ditambahkan'
                ]);
            }
        }
    }

    public function edit($id)
    {
        //
        $editDataPengeluaran = Pengeluaran::with('kategori_pengeluaran')->find($id);
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

    public function editJenisPengeluaran($id)
    {
        //
        $editJenisPengeluaran = kategoriPengeluaran::find($id);
        if ($editJenisPengeluaran) {
            return response()->json([
                'status' => 200,
                'editJenisPengeluaran' => $editJenisPengeluaran,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Data Jenis Pengeluaran Tidak Ditemukan',
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
                $updateDataPengeluaran->nama_pengeluaran = $request->input('nama_pengeluaran');
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

    public function updateJenisPengeluaran(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'jenis_pengeluaran' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $updateJenisPengeluaran = kategoriPengeluaran::find($id); //nama model migrasi database
            if ($updateJenisPengeluaran) {
                $updateJenisPengeluaran->kategori_pengeluaran = $request->input('jenis_pengeluaran');
                $updateJenisPengeluaran->update();
                return response()->json([
                    'status' => 200,
                    'message' => 'Jenis Pengeluaran Berhasil Diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Jenis Pengeluaran Tidak Ditemukan',
                ]);
            }
        }
    }
}
