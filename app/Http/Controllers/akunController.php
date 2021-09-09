<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;



class akunController extends Controller
{
    public function index()
    {
        return view('kd_akun.kd_akun',[
            "title" => "Kelola Akun",
            "name" => "Obed Jack",
            "judul_konten" => "Data Akun",
            "data_akun_sementara" => Akun::all(),
        ]);
    }

   /*  public function editDataAkun($username)
    {
        return view('kd_akun.edit_akun', [
            "title" => "Edit Data Akun",
            "name" => "Gredo Jack",
            "judul_konten" => "Data Akun",
            "new_data" => akunModel::firstWhere('username', $username)
            
        ]);
    } */

      // GET ALL PENGELUARAN
      public function getAkunList()
      {
          $countries = Akun::all();
          return DataTables::of($countries)
              ->addIndexColumn()
              ->addColumn('actions', function ($row) {
                  return '<div style="white-space: nowrap; class="text-center">
                  <button id="editBtnAkun" type="button" class="btn btn-primary btn-sm d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalEdit" value="' . $row['id'] . '">
                  <i class="fa fa-pencil-square-o fa-sm text-white-50"></i>&nbsp;Edit</button>
                  <button id="hapusBtnAkun" class="btn btn-danger btn-sm d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalHapus" value="' . $row['id'] . '">
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
              'add_namaAkun' => 'required',
              'add_username' => 'required|unique:akuns,username', //make nama tabel bukan nama model //validasi unique
              'add_password' => 'required',
              'add_noHpAkun' => 'required|numeric',
              'add_tipeAkun' => 'required|numeric',
              'add_alamatAkun' => 'required',
          ]);
  
          if ($validator->fails()) {
              return response()->json([
                  'status' => 400,
                  'errors' => $validator->messages(),
              ]);
          } else {
              $addDataAkun = new Akun(); //nama model migrasi database
              $addDataAkun->nama = $request->input('add_namaAkun');
              $addDataAkun->username = $request->input('add_username');
              $addDataAkun->password = $request->input('add_password');
              $addDataAkun->noHp = $request->input('add_noHpAkun');
              $addDataAkun->tipe = $request->input('add_tipeAkun');
              $addDataAkun->alamat = $request->input('add_alamatAkun');
              $query = $addDataAkun->save();
              if (!$query) {
                  return response()->json([
                      'status' => 200,
                      'code' => 0,
                      'msg' => 'Something went wrong'
                  ]);
              } else {
                  return response()->json([
                      'code' => 1,
                      'msg' => 'Data Akun Berhasil Ditambahkan'
                  ]);
              }
          }
      }
  
      public function edit($id)
      {
          //
          $editDataAkun = Akun::find($id);
          if ($editDataAkun) {
              return response()->json([
                  'status' => 200,
                  'editDataAkun' => $editDataAkun,
              ]);
          } else {
              return response()->json([
                  'status' => 404,
                  'message' => 'Data Akun Tidak Ditemukan',
              ]);
          }
      }

      public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'nama_akun' => 'required',
            'username' => 'required|unique:akuns,username,'.$id, //make nama tabel bukan nama model //validasi unique
            'password' => 'required',
            'noHp_akun' => 'required|numeric',
            'tipe_akun' => 'required|numeric',
            'alamat_akun' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        } else {
            $updateDataAkun = Akun::find($id); //nama model migrasi database
            if ($updateDataAkun) {
                $updateDataAkun->nama = $request->input('nama_akun');
                $updateDataAkun->username = $request->input('username');
                $updateDataAkun->password = $request->input('password');
                $updateDataAkun->noHp = $request->input('noHp_akun');
                $updateDataAkun->tipe = $request->input('tipe_akun');
                $updateDataAkun->alamat = $request->input('alamat_akun');
                $updateDataAkun->update();

                return response()->json([
                    'status' => 200,
                    'message' => 'Data Akun Berhasil Diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Data Akun Tidak Ditemukan',
                ]);
            }
        }
    }

    public function destroy($id)
    {
        //
        $deleteDataAkun = Akun::find($id);
        $deleteDataAkun->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Data Berhasil Dihapus',
        ]);
    }
}