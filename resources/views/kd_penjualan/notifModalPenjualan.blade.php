@extends('layouts.modal')

@section('modal_content')
    <div class="modal-content">
        <div class="modal-header card-header py-3">
            <p class="text-primary m-0 fw-bold">Edit Data Penjualan</p>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
                <div class="row">
                    <div class="mb-3"><label class="form-label" for="city"><strong>Nama
                                Barang</strong></label><input class="form-control" placeholder="Boleh Kosong" type="text"
                            id="city" name="city"></div>
                </div>
                <div class="row">
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>Harga
                                    Masuk</strong></label><input class="form-control" placeholder="Boleh Kosong" type="text"
                                id="city" name="city"></div>
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
                                    Terakhir Diperbaharui</strong></label><input class="form-control" type="date"
                                id="address" placeholder="dd/mm/yyyy">
                        </div>
                    </div>
                </div>
                <div class="mb-3"><label class="form-label" for="city"><strong>
                            Supplier</strong></label><input class="form-control" placeholder="Boleh Kosong" type="text"
                        id="city" name="city"></div>
                <div class="mb-3"><label class="form-label" for="city"><strong>Keterangan
                        </strong></label><textarea class="form-control" placeholder="Boleh Kosong" type="text" id="city"
                        name="city"> </textarea></div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-bs-target="#staticBackdrop3" data-bs-toggle="modal"
                data-bs-dismiss="modal">Save changes</button>
        </div>
    </div>
@endsection

@section('modal_content_tambah')
    <div class="modal-content">
        <div class="modal-header card-header py-3">
            <p class="text-primary m-0 fw-bold">Tambah Data Penjualan</p>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
                <div class="row">
                    <div class="mb-3"><label class="form-label" for="city"><strong>Nama
                                Barang</strong></label><input class="form-control" placeholder="" type="text"
                            id="city" name="city"></div>
                </div>
                <div class="row">
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>Harga
                                    Masuk</strong></label><input class="form-control" placeholder="" type="text"
                                id="city" name="city"></div>
                    </div>
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="country"><strong>
                                    Harga Jual</strong></label><input class="form-control" type="text" id="country"
                                placeholder="" name="country"></div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>Stok
                                    Barang</strong></label><input class="form-control" placeholder=""
                                type="text" id="city" name="city"></div>
                    </div>
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="country"><strong>
                            <i class="fa fa-calendar fa-1x"></i> Terakhir Diperbaharui</strong></label><input class="form-control" type="text"
                                id="address" placeholder="{{ $carbon_today }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="mb-3"><label class="form-label" for="city"><strong>
                            Supplier</strong></label><input class="form-control" placeholder="(Boleh Kosong)" type="text"
                        id="city" name="city"></div>
                <div class="mb-3"><label class="form-label" for="city"><strong>Keterangan
                        </strong></label><textarea class="form-control" placeholder="(Boleh Kosong)" type="text" id="city" name="city"></textarea></div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-bs-target="#staticBackdrop3" data-bs-toggle="modal"
                data-bs-dismiss="modal">Add data</button>
        </div>
    </div>
@endsection