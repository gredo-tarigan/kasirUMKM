@extends('layouts.main')
@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <p class="text-primary m-0 fw-bold">Edit Data Penjualan</p>
    </div>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col">
                    <div class=""><label class="form-label" for="address"><strong>Nama</strong></label><input class="form-control" type="text" id="address" placeholder="{{ $penjualan["namabarang_penjualan"] }}" name="address"></div>
                </div>
                <div class="col">
                    <div class="mb-3"><label class="form-label" for="address"><strong>Posisi</strong></label>
                        <input class="form-control" type="text" placeholder="Kasir" aria-label="Disabled input example" disabled>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class=""><label class="form-label" for="address"><strong>Tempat/Tgl Lahir</strong></label></div>
                    <div class="row">
                        <div class="col">
                            <input class="form-control" type="text" id="address" placeholder="Tempat" name="address">
                        </div>
                        <div class="col">
                            <input class="form-control" type="date" id="address" placeholder="dd/mm/yyyy" name="address">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3"><div class=""><label class="form-label" for="address"><strong>Jenis Kelamin</strong></label></div>
                        <div class="">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                            Laki-laki
                            </label>
                        </div>                          
                        <div class="">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                            Perempuan
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3"><label class="form-label" for="address"><strong>Alamat</strong></label><textarea class="form-control" placeholder="{{ $penjualan["jenis_penjualan"] }}" id="exampleFormControlTextarea1" rows="3"></textarea></div>             
            <div class="row">
                <div class="col">
                    <div class="mb-3"><label class="form-label" for="city"><strong>Username</strong></label><input class="form-control" placeholder="{{ $penjualan["total_pengeluaran"] }}" type="text" id="city" placeholder="Username" name="city"></div>
                </div>
                <div class="col">
                    <div class="mb-3"><label class="form-label" for="country"><strong>Password</strong></label><input class="form-control" type="password" id="country" placeholder="Password" name="country"><span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>{{-- link untuk show / hide password https://codepen.io/Sohail05/pen/yOpeBm --}}</div>
                </div>
            </div>
            <div class="d-flex justify-content-end mb-3"><button class="btn btn-primary btn-sm d-none d-sm-inline-block" type="submit"><i class="fa fa-floppy-o fa-sm text-white-50"></i>&nbsp;&nbsp;Simpan Perubahan</button></div>
        </form>
    </div>
</div>
@endsection