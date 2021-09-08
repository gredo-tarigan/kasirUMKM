<?php

namespace App\Models;


class AkunModel
{
    private static $data_akun_sementara = [
        [
            "nama_ak" => "Petrick Simanjuntak",
            "alamat_ak" => "Semarang Bawah",
            "lahir_ak" => "1 Juni 2000",
            "umur_ak" => "22",
            "posisi_ak" => "Kasir",
            "jk_ak" => "L",
            "username_ak" => "petricksim",
            "pass_ak" => "1"
        ],
        [
            "nama_ak" => "Yudhi Pasaribu",
            "alamat_ak" => "Kontrakan Budi Mulia",
            "lahir_ak" => "1 Januari 2000",
            "umur_ak" => "23",
            "posisi_ak" => "Kasir",
            "jk_ak" => "L",
            "username_ak" => "yudhipas",
            "pass_ak" => "2"
        ],
        [
            "nama_ak" => "Daniel Felix Nainggolan",
            "alamat_ak" => "Undip Ngesrep",
            "lahir_ak" => "1 Februari 2000",
            "umur_ak" => "24",
            "posisi_ak" => "Kasir",
            "jk_ak" => "L",
            "username_ak" => "danielfel",
            "pass_ak" => "3"
        ],
        [
            "nama_ak" => "Siskawati Sianipar",
            "alamat_ak" => "Di Dekat Rumah Makan Batak Toraja",
            "lahir_ak" => "1 September 2020",
            "umur_ak" => "21",
            "posisi_ak" => "Kasir",
            "jk_ak" => "P",
            "username_ak" => "siskaws",
            "pass_ak" => "4"
        ]
        ];

    public static function colDataAkun()
    {
        return collect(self::$data_akun_sementara);
    }

    public static function findDataAkun($username_ak)
    {
        $un_slug = static::colDataAkun(); //un_slug kita pake namanya buat bikin semacam slug tapi fokusnya pake username_akun
       // Karena data yang dipakai sudah menggunakan collection jadi bisa pakai method dari collection yang disediakan oleh laravel
        /*  $arr_dsSlug = []; //arr_sdSlug kita pake namanya buat array sementara memasukkan data yang didapat untuk ditampilkan
        foreach($un_slug as $ds_slug) { //ds_slug kita pake namanya buat data sementara username slug
            if($ds_slug["username_ak"] === $username_ak){
                $arr_dsSlug = $ds_slug;
        }
    } */

    return $un_slug->firstWhere('username_ak', $username_ak);

    }
}
