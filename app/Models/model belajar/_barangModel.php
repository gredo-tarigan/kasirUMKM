<?php

namespace App\Models;


class BarangModel
{
    private static $data_kdBarang = [
        [
            "id_barang" => "1",
            "nama_barang" => "Bakso Goreng",
            "harga_masuk_barang" => "10000",
            "harga_jual_barang" => "20000",
            "stok_barang" => "5",
            "tanggal_barang" => ""
        ],
        [
            "id_barang" => "2",
            "nama_barang" => "Barcelona Coklat",
            "harga_masuk_barang" => "20000",
            "harga_jual_barang" => "30000",
            "stok_barang" => "6",
            "tanggal_barang" => ""
        ],
        [
            "id_barang" => "3",
            "nama_barang" => "Barcelona Pandan",
            "harga_masuk_barang" => "30000",
            "harga_jual_barang" => "40000",
            "stok_barang" => "7",
            "tanggal_barang" => ""
        ],
        [
            "id_barang" => "4",
            "nama_barang" => "Barcelona Strawberry",
            "harga_masuk_barang" => "50000",
            "harga_jual_barang" => "60000",
            "stok_barang" => "8",
            "tanggal_barang" => ""
        ],
    ];

    public static function colDataBarang()
    {
        return collect(self::$data_kdBarang);
    }
}