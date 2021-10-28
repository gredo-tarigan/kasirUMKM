<?php

namespace App\Http\Controllers;

use App\Models\nota;
use Illuminate\Http\Request;
use App\Models\tempPenjualan;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class dashboardController extends Controller
{
    //
    public function index()
    {
        /* $penjualan_today = tempPenjualan::select(
            "id",
            DB::raw("(sum(sub_total)) as profit"),
            DB::raw("(DATE_FORMAT(created_at, '%M')) as month"),
            DB::raw("(DATE_FORMAT(created_at, '%Y')) as year")
        )->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y')"))
            ->whereDate('created_at', Carbon::today())->get();

        $penjualan_yesterday = tempPenjualan::select(
            "id",
            DB::raw("(sum(sub_total)) as profit"),
            DB::raw("(DATE_FORMAT(created_at, '%M')) as month"),
            DB::raw("(DATE_FORMAT(created_at, '%Y')) as year")
        )->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y')"))
            ->whereDate('created_at', Carbon::yesterday())->get(); */

        $penjualan = tempPenjualan::select(
            DB::raw("(sum(sub_total)) as profit"),
            //DB::raw("(DATE_FORMAT(created_at, '%M')) as month"),
            //DB::raw("(DATE_FORMAT(created_at, '%Y')) as year")
        )->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y')"));

        $penjualan_today = $penjualan->whereDate('created_at', Carbon::today())->get();
        $penjualan_yesterday = $penjualan->whereDate('created_at', Carbon::yesterday())->get();
        $penjualan_thisMonth = tempPenjualan::select(
            DB::raw("(sum(sub_total)) as profit"),
        )->groupBy(DB::raw("DATE_FORMAT(created_at, '%M')"));

        $pelanggan_today = nota::whereDate('created_at', Carbon::today())->get()->count('id');
        $posts = tempPenjualan::whereDate('created_at', Carbon::today())->get();

        $transactions = tempPenjualan::all();
        $array = array();
        foreach ($transactions as $no => $transaction) {
            array_push($array, $transactions[$no]->created_at->toDateString());
        }
        $dates = array_unique($array);
        rsort($dates);

        $arr_ammount = count($dates);
        $incomes_data = array();
        if ($arr_ammount > 7) {
            for ($i = 0; $i < 7; $i++) {
                array_push($incomes_data, $dates[$i]);
            }
        } elseif ($arr_ammount > 0) {
            for ($i = 0; $i < $arr_ammount; $i++) {
                array_push($incomes_data, $dates[$i]);
            }
        }

        $incomes = array_reverse($incomes_data);

        return view('dashboard.dashboard', [
            "title" => "Dashboard",
            "judul_konten" => "Tarigan Jack",
            "carbon_today" => Carbon::today(),
            "penjualan_today" => $penjualan_today,
            "pelanggan_today" => $pelanggan_today,
            "penjualan_yesterday" => $penjualan_yesterday,
            "aw" => $posts,
            //"transaksi" => nota::whereDate('created_at', Carbon::today())->get(),
            "transaction" => nota::latest()->paginate(5),


        ], compact('incomes'));
    }

    public function filterChartDashboard($filter)
    {
        if ($filter == 'pemasukan') {
            $supplies = tempPenjualan::all();
            $array = array();
            foreach ($supplies as $no => $supply) {
                array_push($array, $supplies[$no]->created_at->toDateString());
            }
            $dates = array_unique($array);
            rsort($dates);
            $arr_ammount = count($dates);
            $incomes_data = array();
            if ($arr_ammount > 7) {
                for ($i = 0; $i < 7; $i++) {
                    array_push($incomes_data, $dates[$i]);
                }
            } elseif ($arr_ammount > 0) {
                for ($i = 0; $i < $arr_ammount; $i++) {
                    array_push($incomes_data, $dates[$i]);
                }
            }
            $incomes = array_reverse($incomes_data);
            $total = array();
            foreach ($incomes as $no => $income) {
                array_push($total, tempPenjualan::whereDate('created_at', $income)->sum('sub_total'));
            }

            return response()->json([
                'incomes' => $incomes,
                'total' => $total
            ]);
        } else {
            $supplies = tempPenjualan::all();
            $array = array();
            foreach ($supplies as $no => $supply) {
                array_push($array, $supplies[$no]->created_at->toDateString());
            }
            $dates = array_unique($array);
            rsort($dates);
            $arr_ammount = count($dates);
            $customer_data = array();
            if ($arr_ammount > 7) {
                for ($i = 0; $i < 7; $i++) {
                    array_push($customer_data, $dates[$i]);
                }
            } elseif ($arr_ammount > 0) {
                for ($i = 0; $i < $arr_ammount; $i++) {
                    array_push($customer_data, $dates[$i]);
                }
            }
            $customers = array_reverse($customer_data);
            $jumlah = array();
            foreach ($customers as $no => $customer) {
                array_push($jumlah, tempPenjualan::whereDate('created_at', $customer)->count());
            }

            return response()->json([
                'customers' => $customers,
                'jumlah' => $jumlah
            ]);
        }
    }
}
