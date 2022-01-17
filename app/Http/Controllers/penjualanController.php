<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\nota;
use Illuminate\Http\Request;
use App\Models\tempPenjualan;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;


class penjualanController extends Controller
{

    public function penjualan()
    {

        /* $visitors = tempPenjualan::select(
            "id" ,
            DB::raw("(sum(sub_total)) as total_perYear"),
            DB::raw("(DATE_FORMAT(created_at, '%d-%m-%Y')) as my_date")
            )
            ->orderBy('created_at')
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))
            ->get(); */

        $visitors = tempPenjualan::select(
            "id",
            DB::raw("(sum(sub_total)) as profit"),
            DB::raw("(DATE_FORMAT(created_at, '%M')) as month"),
            DB::raw("(DATE_FORMAT(created_at, '%Y')) as year")
        )->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y')"))
            ->orderBy('year')->get();


        // $data['year_list'] = $this->fetch_year();
        return view('kd_penjualan.kd_penjualan', [
            "title" => "Kelola Data Penjualan",
            "judul_konten" => "Data Penjualan",
            "carbon_today" => Carbon::today()->isoFormat('dddd, D MMMM Y'),
            "result" => $visitors,
        ]);
    }

    // ---------------------------------- //

    /* public function fetch_year() {
        $data = tempPenjualan::select(
            "id",
            DB::raw("(sum(sub_total)) as total_perYear"),
            DB::raw("(DATE_FORMAT(created_at, '%M')) as month"),
            DB::raw("(DATE_FORMAT(created_at, '%Y')) as my_date")
        )->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y')"))
            ->orderBy('created_at', 'DESC')->get();
        return $data;
    }
 */
    /* public function fetch_data(Request $request)
    {
        if ($request->input('year')) {
            $chart_data = $this->fetchDataChart($request->input('year'));

            foreach($chart_data->toArray() as $row) {
                $output[] = array(
                    'month'  => $row->month,
                    'profit' => floatval($row->profit)
                );
            }
            echo json_encode($output);
        }
    }

    public function fetchDataChart($year)
    {
        $data = tempPenjualan::select(
            "id",
            DB::raw("(sum(sub_total)) as profit"),
            DB::raw("(DATE_FORMAT(created_at, '%M')) as month"),
            DB::raw("(DATE_FORMAT(created_at, '%Y')) as year")
        )->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y')"))
            ->orderBy('year', 'ASC')->where('year', $year)->get();

        return $data;
    } */

    // ---------------------------------- //
    public function getPenjualanList()
    {
        $countries = nota::with('relasi_tempPenjualan.barang', 'relasi_tempPenjualan.kategori_penjualan');
        //$countriess = nota::all();
        return DataTables::of($countries)
            ->addIndexColumn()
            /*  ->addColumn('actions', function ($row) {
                return '<div style="white-space: nowrap; class="text-center">
                <button id="editBtnPenjualan" type="button" class="btn btn-primary btn-sm d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalEdit" value="' . $row['id'] . '">
                <i class="fa fa-pencil-square-o fa-sm text-white-50"></i>&nbsp;Edit</button>
                <button id="hapusBtnPenjualan" class="btn btn-danger btn-sm d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalHapus" value="' . $row['id'] . '">
                <i class="fa fa-trash-o fa-sm text-white-50"></i>&nbsp;Hapus</button>
                </div>';
            }) */
            ->addColumn('total', function ($row) {
                return $row->relasi_tempPenjualan->sum('sub_total');
            })

            /* ->addColumn('detail', function ($row){
                return $row->relasi_tempPenjualan->map->only('barang_id', 'massa_pieces', 'kategori_penjualan_id', 'harga_jadi', 'sub_total');
                
                 }) */
            ->addColumn('detail', function ($row) {
                return '<div style="white-space: nowrap;" class="text-center">
                <button id="detailBtnPenjualan" type="button" class="btn btn-success btn-sm d-none d-sm-inline-block text-white" data-bs-toggle="modal" data-bs-target="#modalTabel" value="' . $row['id'] . '">
                <i class="fa fa-list fa-sm text-white-50"></i>&nbsp;Detail Nota</button></div>';
            })

            ->addColumn('detail2', function ($row) {
                return $row->relasi_tempPenjualan->pluck('massa_pieces')->toArray();
            })
            ->rawColumns(['detail'])
            ->make(true);
    }

    public function getLaporanPenjualanList()
    {
        $countries = tempPenjualan::latest()->select(
            DB::raw("(sum(sub_total)) as total"),
            DB::raw("(DATE_FORMAT(created_at, '%M %Y')) as perMonth")
            )
            ->orderBy('created_at')
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%M %Y')"))->get();
        return DataTables::of($countries)
            ->addIndexColumn()
            ->editColumn('created_at_LP', function ($row) {
                return $row->perMonth;
            })
            ->editColumn('total_LP', function ($row) {
                return $row->total;
            })
            ->make(true);
    }

    public function getDetailPenjualan($id)
    {
        //
        $detailPenjualan = nota::find($id);

        return response()->json([

            'detailPenjualan' => $detailPenjualan,
        ]);
    }

    public function getDetailPenjualanTabel($id)
    {
        $countries = tempPenjualan::where('nota_id', $id);
        return DataTables::of($countries)
            ->addIndexColumn()
            ->editColumn('barang_id', function ($row) {
                return $row->barang->nama;
            })
            ->addColumn('penjualan', function ($row) {
                return $row->kategori_penjualan->kategori_penjualan;
            })
            ->make(true);
    }
}
