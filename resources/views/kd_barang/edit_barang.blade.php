@extends('layouts.main')
@extends('layouts.modal')
@section('content')
<div class="card shadow">
    <div class="card-header py-3">
        <p class="text-primary m-0 fw-bold">Edit Data Barang</p>
    </div>
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col">
                    <div class=""><label class="form-label" for="address"><strong>Nama Barang</strong></label>
                        <input class="form-control" type="text" id="address" placeholder="{{ $barang["hargajual_barang"] }}" name="address">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3"><label class="form-label" for="address"><strong>Stok Barang</strong></label>
                        <input class="form-control" type="text" id="address" placeholder="{{ $barang["stok_barang"] }}" name="address">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <div class=""><label class="form-label" for="address"><strong>Harga Masuk</strong></label></div>
                            <input class="form-control" type="text" id="address" placeholder="Tempat" name="address">
                        </div>
                        <div class="col">
                            <div class=""><label class="form-label" for="address"><strong>Harga Jual</strong></label></div>
                            <input class="form-control" type="text" placeholder="Tanggal Terakhir Diperbaharui" aria-label="Disabled input example" disabled>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3"><div class=""><label class="form-label" for="address"><strong>Terakhir Diperbaharui</strong></label></div>
                         <input class="form-control" type="date" id="address" placeholder="dd/mm/yyyy">
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-end mb-3"><button class="btn btn-primary btn-sm d-none d-sm-inline-block" type="submit"><i class="fa fa-floppy-o fa-sm text-white-50"></i>&nbsp;&nbsp;Simpan Perubahan</button></div>
        </form>
    </div>
</div>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Launch static backdrop modal
  </button>
@endsection
@section('modal_content')
            <form>
                <div class="row">
                    <div class="mb-3"><label class="form-label" for="city"><strong>Nama
                        Barang</strong></label><input class="form-control" placeholder="Boleh Kosong"
                    type="text" id="city" name="city"></div>
                </div>
                <div class="row">
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>Harga
                                    Masuk</strong></label><input class="form-control" placeholder="Boleh Kosong"
                                type="text" id="city" name="city"></div>
                    </div>
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="country"><strong>
                                    Harga Jual</strong></label><input class="form-control" type="text" id="country"
                                placeholder="XXX" name="country" disabled></div>
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>Stok
                                    Barang</strong></label><input class="form-control" placeholder="Boleh Kosong"
                                type="text" id="city" name="city"></div>
                    </div>
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="country"><strong>
                                    Terakhir Diperbaharui</strong></label><input class="form-control" type="date" id="address" placeholder="dd/mm/yyyy">
                                </div>
                    </div>                   
                </div>
                    <div class="mb-3"><label class="form-label" for="city"><strong>
                        Supplier</strong></label><input class="form-control" placeholder="Boleh Kosong"
                    type="text" id="city" name="city"></div>
                    <div class="mb-3"><label class="form-label" for="city"><strong>Keterangan
                        </strong></label><textarea class="form-control" placeholder="Boleh Kosong"
                    type="text" id="city" name="city"> </textarea></div>
            </form>
@endsection
@section('modal_content_notification')

    
@endsection