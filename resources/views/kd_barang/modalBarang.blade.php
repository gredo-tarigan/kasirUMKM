@extends('layouts.modal')

@section('modal_content')
    <div class="modal-content">
        <div class="modal-header crd-header py-3">
            <p class="text-primary m-0 fw-bold">Edit Data Barang</p>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
                <ul id="updateform_errList"></ul>
                <div class="row">
                    <input type="hidden" id="edit_DB_id">
                    <div class="mb-3"><label class="form-label" for="city"><strong>Nama
                                Barang</strong></label><input class="form-control" placeholder="" type="text" id="edit_nb"
                            name=""></div>
                </div>
                <div class="row">
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>Harga
                                    Masuk</strong></label><input class="form-control" placeholder="Boleh Kosong"
                                type="text" id="edit_hmb" name=""></div>
                    </div>
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="country"><strong>
                                    Harga Jual</strong></label><input class="form-control" type="text" id="edit_hjb"
                                placeholder="" name="" disabled></div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>Stok
                                    Barang</strong></label><input class="form-control" placeholder="Boleh Kosong"
                                type="text" id="edit_stob" name=""></div>
                    </div>
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>
                                    Supplier</strong></label><input class="form-control" placeholder="Boleh Kosong"
                                type="text" id="edit_supb" name=""></div>
                    </div>
                    {{-- <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="country"><strong>
                                    Terakhir Diperbaharui</strong></label><input class="form-control" type="date"
                                id="edit_lu" placeholder="dd/mm/yyyy">
                        </div>
                    </div> --}}
                </div>
                <div class="row">
                    <div class="col-lg">
                        {{-- <div class="mb-3"><label class="form-label" for="city"><strong>Kategori
                                    Barang</strong></label>
                            <input class="form-control" placeholder="" type="text" id="add_kategoriBarang" name="">
                        </div> --}}
                    </div>
                    {{-- <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>Penjualan
                                    Barang</strong></label>
                            <select class="custom-select" id="add_kategoriPenjualan">
                                <option selected>Choose...</option>
                                <option value="1">per Pieces</option>
                                <option value="2">Eceran</option>
                            </select>
                        </div>
                    </div> --}}
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="country"><strong>
                                    Kategori Penjualan</strong></label>
                            <select class="form-select" aria-label="Default select example" id="edit_kategori_penjualan">
                                @foreach ($kategori_penjualan as $item)
                                    <option value="{{ $item->id }}">{{ $item->kategori_penjualan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mb-3"><label class="form-label" for="city"><strong>Keterangan
                        </strong></label><textarea class="form-control" placeholder="Boleh Kosong" type="text"
                        id="edit_kb" name=""> </textarea></div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="update_barangBtn" type="button" class="btn btn-primary">Update Data</button>
        </div>
    </div>
@endsection

@section('modal_content_tambah')
    <div class="modal-content">
        <div class="modal-header card-header py-3">
            <p class="text-primary m-0 fw-bold">Tambah Data Barang</p>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
                <ul id="saveform_errList"></ul>
                <div class="row">
                    <div class="mb-3"><label class="form-label" for="city"><strong>Nama
                                Barang</strong></label><input class="form-control" placeholder="" type="text" id="add_nb"
                            name="add_nb">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>Harga
                                    Masuk</strong></label><input class="form-control" placeholder="" type="text"
                                id="add_hmb" name="add_hmb">
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="country"><strong>
                                    Harga Jual</strong></label><input class="form-control" type="text" id="add_hjb"
                                placeholder="" name="add_hjb">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>Stok
                                    Barang</strong></label><input class="form-control" placeholder="" type="text"
                                id="add_stob" name="add_stob">
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>
                                    Supplier</strong></label><input class="form-control" placeholder="(Boleh Kosong)"
                                type="text" id="add_supb" name="add_supb">
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>Kategori
                                    Barang</strong></label>
                            <input class="form-control" placeholder="" type="" id="add_kategori_barang"
                                name="add_kategori_barang">
                        </div>
                    </div> --}}
                    {{-- <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>Penjualan
                                    Barang</strong></label>
                            <select class="custom-select" id="add_kategori_penjualan">
                                <option selected>Choose...</option>
                                <option value="1">Eceran</option>
                                <option value="2">Per Pieces</option>
                            </select>
                        </div>
                    </div> --}}
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="country"><strong>
                                    Kategori Penjualan</strong></label>
                            <select class="form-select" aria-label="Default select example" id="add_kategori_penjualan">
                                @foreach ($kategori_penjualan as $item)
                                    <option value="{{ $item->id }}">{{ $item->kategori_penjualan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-3"><label class="form-label" for="city"><strong>Keterangan
                        </strong></label><textarea class="form-control" placeholder="(Boleh Kosong)" type="text"
                        id="add_kb" name="add_kb"></textarea>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" data-bs-target="" data-bs-toggle="" data-bs-dismiss=""
                    id="add_data_barang">Add data</button>
            </div>
        </div>
    </div>
@endsection

@section('modal_content_hapus')
    <div class="modal-content">
        <div class="modal-header card-header py-3">
            <p class="text-primary m-0 fw-bold">Hapus Data Barang</p>
        </div>
        <div class="modal-body">
            <input type="hidden" id="delete_DB_id">
            <text>Apakah Anda Yakin Untuk Menghapus Data Ini?</text>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-bs-target="" data-bs-toggle="" data-bs-dismiss=""
                id="delete_data_barang">Delete Data</button>
        </div>
    </div>
@endsection
