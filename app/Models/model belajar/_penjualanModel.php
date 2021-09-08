<?php

namespace App\Models;


class PenjualanModel
{
    private static $data_kdPenjualan = [
        [
            "id_penjualan" => "ABCD",
            "tanggal_barang" => "040821",
            "nama_barang" => "Bakso Goreng, Barcelona Coklat",
            "total_barang" => "5000"
        ],
        [
            "id_penjualan" => "EFGH",
            "tanggal_barang" => "040821",
            "nama_barang" => "Bakso Goreng, Barcelona Coklat",
            "total_barang" => "5000"
        ],
        [
            "id_penjualan" => "IJKL",
            "tanggal_barang" => "040821",
            "nama_barang" => "Bakso Goreng, Barcelona Coklat",
            "total_barang" => "5000"
        ],
        [
            "id_penjualan" => "MNOP",
            "tanggal_barang" => "040821",
            "nama_barang" => "Bakso Goreng, Barcelona Coklat",
            "total_barang" => "5000"
        ],
    ];

    public static function colDataPenjualan()
    {
        return collect(self::$data_kdPenjualan);
    }
}