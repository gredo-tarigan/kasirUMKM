<?php

namespace Database\Seeders;

use App\Models\Akun;
use App\Models\Barang;
use App\Models\kategoriAkun;
use App\Models\kategoriPengeluaran;
use App\Models\kategoriPenjualan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        kategoriAkun::create([
            'kategori_akun' => 'Kasir'
        ]);
        
        kategoriAkun::create([
            'kategori_akun' => 'Owner'
        ]);

        kategoriPengeluaran::create([
            'kategori_pengeluaran' => 'Toko',
        ]);

        kategoriPengeluaran::create([
            'kategori_pengeluaran' => 'Rumah',
        ]);

        Akun::create([
            'username' => 'owner',
            'password' => bcrypt('owner'),
            'nama' => 'owner',
            'noHp' => '0',
            'alamat' => 'owner',
            'kategori_akun_id' => '2'
        ]);

        Akun::create([
            'username' => 'kasir',
            'password' => bcrypt('kasir'),
            'nama' => 'Kasir Pertama',
            'noHp' => '081',
            'alamat' => 'Semarang',
            'kategori_akun_id' => '1'
        ]);

        kategoriPenjualan::create([
            'kategori_penjualan' => 'pcs',
        ]);
        
        kategoriPenjualan::create([
            'kategori_penjualan' => 'kg',
        ]);     

        Barang::create([
            'nama' => 'Bakso Goreng',
            'harga_masuk' => '68000',
            'harga_jual' => '78000',
            'stok' => '10',
            'supplier' => 'Sapardi',
            'keterangan' => 'Kontan',
            'kategori_penjualan_id' => '2',
        ]);

        Barang::create([
            'nama' => 'Barcelona Coklat',
            'harga_masuk' => '110000',
            'harga_jual' => '120000',
            'stok' => '10',
            'supplier' => 'Sumanggalo',
            'keterangan' => 'Kontan',
            'kategori_penjualan_id' => '2',
        ]);

        Barang::create([
            'nama' => 'Barcelona Pandan',
            'harga_masuk' => '110000',
            'harga_jual' => '120000',
            'stok' => '10',
            'supplier' => 'Sumanggalo',
            'keterangan' => 'Kontan',
            'kategori_penjualan_id' => '2',
        ]);

        Barang::create([
            'nama' => 'Barcelona Strawberry',
            'harga_masuk' => '110000',
            'harga_jual' => '120000',
            'stok' => '10',
            'supplier' => 'Sumanggalo',
            'keterangan' => 'Kontan',
            'kategori_penjualan_id' => '2',
        ]);

        Barang::create([
            'nama' => 'Barcelona Susu',
            'harga_masuk' => '110000',
            'harga_jual' => '120000',
            'stok' => '10',
            'supplier' => 'Sumanggalo',
            'keterangan' => 'Kontan',
            'kategori_penjualan_id' => '2',
        ]);

        Barang::create([
            'nama' => 'Barcelona Susu',
            'harga_masuk' => '110000',
            'harga_jual' => '120000',
            'stok' => '10',
            'supplier' => 'Sumanggalo',
            'keterangan' => 'Kontan',
            'kategori_penjualan_id' => '2',
        ]);

        Barang::create([
            'nama' => 'Barcelona Vanilla',
            'harga_masuk' => '110000',
            'harga_jual' => '120000',
            'stok' => '10',
            'supplier' => 'Joko',
            'keterangan' => 'Kontan',
            'kategori_penjualan_id' => '2',
        ]);

        Barang::create([
            'nama' => 'Brem',
            'harga_masuk' => '56000',
            'harga_jual' => '66000',
            'stok' => '10',
            'supplier' => 'Supatmo',
            'keterangan' => 'Kontan',
            'kategori_penjualan_id' => '2',
        ]);

        Barang::create([
            'nama' => 'Cendol Keju KR',
            'harga_masuk' => '80000',
            'harga_jual' => '90000',
            'stok' => '10',
            'supplier' => 'Jeremi',
            'keterangan' => 'Kontan',
            'kategori_penjualan_id' => '2',
        ]);

        Barang::create([
            'nama' => 'CIKO Chikoball',
            'harga_masuk' => '44000',
            'harga_jual' => '54000',
            'stok' => '10',
            'supplier' => 'Erika',
            'keterangan' => 'Kontan',
            'kategori_penjualan_id' => '2',
        ]);

        Barang::create([
            'nama' => 'CIKO Chococrunch Coklat',
            'harga_masuk' => '42000',
            'harga_jual' => '52000',
            'stok' => '10',
            'supplier' => 'Erika',
            'keterangan' => 'Kontan',
            'kategori_penjualan_id' => '2',
        ]);

        Barang::create([
            'nama' => 'CIKO Chococrunch Rainbow',
            'harga_masuk' => '40000',
            'harga_jual' => '42000',
            'stok' => '10',
            'supplier' => 'Erika',
            'keterangan' => 'Kontan',
            'kategori_penjualan_id' => '2',
        ]);

        Barang::create([
            'nama' => 'Ciput Nuri',
            'harga_masuk' => '77000',
            'harga_jual' => '87000',
            'stok' => '10',
            'supplier' => 'Julian',
            'keterangan' => 'Kontan',
            'kategori_penjualan_id' => '2',
        ]);

        Barang::create([
            'nama' => 'Floridina',
            'harga_masuk' => '2000',
            'harga_jual' => '4000',
            'stok' => '100',
            'supplier' => 'Matias',
            'keterangan' => 'Kontan',
            'kategori_penjualan_id' => '1',
        ]);

        Barang::create([
            'nama' => 'Teh Pucuk',
            'harga_masuk' => '2000',
            'harga_jual' => '5000',
            'stok' => '100',
            'supplier' => 'Matias',
            'keterangan' => 'Kontan',
            'kategori_penjualan_id' => '1',
        ]);

        Barang::create([
            'nama' => 'Pocari Sweat',
            'harga_masuk' => '4500',
            'harga_jual' => '6500',
            'stok' => '100',
            'supplier' => 'Matias',
            'keterangan' => 'Kontan',
            'kategori_penjualan_id' => '1',
        ]);

        Barang::create([
            'nama' => 'Caffino',
            'harga_masuk' => '1500',
            'harga_jual' => '3500',
            'stok' => '100',
            'supplier' => 'Matias',
            'keterangan' => 'Kontan',
            'kategori_penjualan_id' => '1',
        ]);
    }
}
