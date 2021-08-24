<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\akunController;
use App\Http\Controllers\barangController;
use App\Http\Controllers\pengeluaranController;
use App\Http\Controllers\penjualanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard',[
        "title" => "Dashboard",
        "name" => "Jack Gredo",
        "judul_konten" => ""
    ]);
});

Route::get('account/add', function () {
    return view('kd_akun.tambah_akun',[
        "title" => "Kelola Data Barang",
        "name" => "Gredo Jack",
        "judul_konten" => "Data Barang"
    ]);
});

Route::get('/profil', function () {
    return view('profile',[
        "title" => "Kelola Data Pengeluaran",
        "name" => "Tarigan Jack"
    ]);
});

Route::get('/cashier', function () {
    return view('kasir.kasir',[
        "title" => "Kasir",
        "name" => "Tarigan Jack",
        "judul_konten" => "Tarigan Jack"

    ]);
});

Route::get('account', [akunController::class, 'index']);
Route::get('account/edit/{username}', [akunController::class, 'editDataAkun']);

Route::get('goods', [barangController::class, 'barang']);
Route::get('goods/edit/{barang_slug:slug}', [barangController::class, 'editDataBarang']);

Route::get('/sales', [penjualanController::class, 'penjualan']);
Route::get('sales/edit/{penjualan_slug:slug}', [penjualanController::class, 'editDataPenjualan']);


Route::get('/expenses', [pengeluaranController::class, 'pengeluaran']);
Route::get('expenses/edit/{pengeluaran_slug:slug}', [pengeluaranController::class, 'editDataPengeluaran']);
