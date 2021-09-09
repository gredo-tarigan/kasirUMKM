<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\akunController;
use App\Http\Controllers\barangController;
use App\Http\Controllers\kasirController;
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

Route::get('cashier', [kasirController::class, 'kasir']);
Route::get('/get-dataTempPenjualan', [kasirController::class, 'getTempPenjualanList'])->name('get.tempPenjualan.list');


Route::get('account', [akunController::class, 'index']);
Route::post('account', [akunController::class, 'store']);
Route::get('/get-dataAkun', [akunController::class, 'getAkunList'])->name('get.akun.list');
Route::get('edit-dataAkun/{id}', [akunController::class, 'edit']);
Route::put('update-dataAkun/{id}', [akunController::class, 'update']);
Route::delete('delete-dataAkun/{id}', [akunController::class, 'destroy']);

 


Route::get('goods', [barangController::class, 'barang',]);
Route::post('goods', [barangController::class, 'store',]);
//Route::get('fetch-dataBarang', [barangController::class, 'fetchDataBarang']);
Route::get('edit-dataBarang/{id}', [barangController::class, 'edit']);
Route::put('update-dataBarang/{id}', [barangController::class, 'update']);
Route::delete('delete-dataBarang/{id}', [barangController::class, 'destroy']);

Route::get('/get-dataBarang', [barangController::class, 'getCountriesList'])->name('get.countries.list');


Route::get('goods/edit/{barang_slug:slug}', [barangController::class, 'editDataBarang']);


Route::get('/sales', [penjualanController::class, 'penjualan']);
Route::get('sales/edit/{penjualan_slug:slug}', [penjualanController::class, 'editDataPenjualan']);


Route::get('/expenses', [pengeluaranController::class, 'pengeluaran']);
Route::get('/get-dataPengeluaran', [pengeluaranController::class, 'getPengeluaranList'])->name('get.pengeluaran.list');
Route::delete('delete-dataPengeluaran/{id}', [pengeluaranController::class, 'destroy']);
Route::post('expenses', [pengeluaranController::class, 'store',]);
Route::get('edit-dataPengeluaran/{id}', [pengeluaranController::class, 'edit']);
Route::put('update-dataPengeluaran/{id}', [pengeluaranController::class, 'update']);