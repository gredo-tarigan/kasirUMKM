<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\akunController;
use App\Http\Controllers\kasirController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\barangController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\penjualanController;
use App\Http\Controllers\pengeluaranController;
use App\Http\Middleware\cekLevelAkun;

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

/* Route::get('/', function () {
    return view('dashboard', [
        "title" => "Dashboard",
        "name" => "Jack Gredo",
        "judul_konten" => ""
    ]);
}); */

Route::get('/', [loginController::class, 'loginView'])->name('login')->middleware('guest');
Route::post('/', [loginController::class, 'authenticate']);
Route::post('/logout', [loginController::class, 'logout']);

/* Route::get('account/add', function () {
    return view('kd_akun.tambah_akun', [
        "title" => "Kelola Data Barang",
        "name" => "Gredo Jack",
        "judul_konten" => "Data Barang"
    ]);
}); */

/* Route::get('/profil', function () {
    return view('profile', [
        "title" => "Kelola Data Pengeluaran",
        "name" => "Tarigan Jack"
    ]);
});
 */

Route::group(['middleware' => ['auth', 'cekLevelAkun:1, 2']], function(){
    Route::get('cashier', [kasirController::class, 'kasir']);
    Route::get('goods', [barangController::class, 'barang',]);
    Route::get('/sales', [penjualanController::class, 'penjualan']);
    //Route::get('/expenses', [pengeluaranController::class, 'pengeluaran']);
    Route::get('/dashboard', [dashboardController::class, 'index']);

});

Route::group(['middleware'=> ['auth', 'cekLevelAkun:2']], function(){
    Route::get('account', [akunController::class, 'index']);
    Route::get('/expenses', [pengeluaranController::class, 'pengeluaran']);
});


// Route::get('cashier', [kasirController::class, 'kasir'])->middleware('auth', 'cekLevelAkun:1, 2');
Route::post('/cashier-id_nota', [kasirController::class, 'passIdNota']);
Route::post('/cashier-no_nota', [kasirController::class, 'passNoNota']);
Route::get('/get-dataTempPenjualan', [kasirController::class, 'getTempPenjualanList'])->name('get.tempPenjualan.list');
Route::get('/get-dataTotal', [kasirController::class, 'dataPassing']);
Route::post('cashier', [kasirController::class, 'store']);
Route::post('cashier-toNota', [kasirController::class, 'storeNota']);
Route::delete('delete-dataTempPenjualan/{id}', [kasirController::class, 'destroy']);


// Route::get('account', [akunController::class, 'index'])->middleware('auth');
Route::post('account', [akunController::class, 'store']);
Route::get('/get-dataAkun', [akunController::class, 'getAkunList'])->name('get.akun.list');
Route::get('edit-dataAkun/{id}', [akunController::class, 'edit']);
Route::put('update-dataAkun/{id}', [akunController::class, 'update']);
Route::delete('delete-dataAkun/{id}', [akunController::class, 'destroy']);




// Route::get('goods', [barangController::class, 'barang',])->middleware('auth');
Route::post('goods', [barangController::class, 'store',]);
//Route::get('fetch-dataBarang', [barangController::class, 'fetchDataBarang']);
Route::get('edit-dataBarang/{id}', [barangController::class, 'edit']);
Route::put('update-dataBarang/{id}', [barangController::class, 'update']);
Route::delete('delete-dataBarang/{id}', [barangController::class, 'destroy']);

Route::get('/get-dataBarang', [barangController::class, 'getCountriesList'])->name('get.countries.list');


// Route::get('goods/edit/{barang_slug:slug}', [barangController::class, 'editDataBarang']);


// Route::get('/sales', [penjualanController::class, 'penjualan'])->middleware('auth');
Route::get('/get-dataPenjualan', [penjualanController::class, 'getPenjualanList'])->name('get.penjualan.list');
Route::get('edit-dataPenjualan/{id}', [penjualanController::class, 'edit'])->name('yombex.list');


// Route::get('/expenses', [pengeluaranController::class, 'pengeluaran'])->middleware('auth');
Route::get('/get-dataPengeluaran', [pengeluaranController::class, 'getPengeluaranList'])->name('get.pengeluaran.list');
Route::delete('delete-dataPengeluaran/{id}', [pengeluaranController::class, 'destroy']);
Route::post('expenses', [pengeluaranController::class, 'store',]);
Route::get('edit-dataPengeluaran/{id}', [pengeluaranController::class, 'edit']);
Route::put('update-dataPengeluaran/{id}', [pengeluaranController::class, 'update']);
