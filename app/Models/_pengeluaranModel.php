<?php

namespace App\Models;


class PengeluaranModel
{
    private static $data_kdPengeluaran = [
        [
            "id_pengeluaran" => "ABCD",
            "ket_pengeluaran" => "040821",
            "jenis_pengeluaran" => "Beli Bakso",
            "tgl_pengeluaran" => "250221",
            "nominal_pengeluaran" => "250221"
        ],
        [
            "id_pengeluaran" => "ABCD",
            "ket_pengeluaran" => "040821",
            "jenis_pengeluaran" => "Beli Makan",
            "tgl_pengeluaran" => "250221",
            "nominal_pengeluaran" => "250221"
        ],
        [
            "id_pengeluaran" => "ABCD",
            "ket_pengeluaran" => "040821",
            "jenis_pengeluaran" => "Nyewa Intel",
            "tgl_pengeluaran" => "250221",
            "nominal_pengeluaran" => "250221"
        ],
        [
            "id_pengeluaran" => "ABCD",
            "ket_pengeluaran" => "040821",
            "jenis_pengeluaran" => "Bayar Mafia",
            "tgl_pengeluaran" => "250221",
            "nominal_pengeluaran" => "250221"
        ],
        [
            "id_pengeluaran" => "ABCD",
            "ket_pengeluaran" => "040821",
            "jenis_pengeluaran" => "Eksekusi",
            "tgl_pengeluaran" => "250221",
            "nominal_pengeluaran" => "250221"
        ],
        
    ];

    public static function colDataPengeluaran()
    {
        return collect(self::$data_kdPengeluaran);
    }
}