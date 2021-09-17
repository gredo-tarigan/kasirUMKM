@extends('layouts.modal')

@section('modal_content')
    <div class="modal-content">
        <div class="modal-header crd-header py-3">
            <p class="text-primary m-0 fw-bold">Edit Data Akun</p>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
                <ul id="updateform_errList"></ul>
                <div class="row">
                    <input type="hidden" id="edit_DAkun_id">
                    <div class="mb-3"><label class="form-label" for="city"><strong>Nama
                                Akun</strong></label><input class="form-control" placeholder="" type="text" id="edit_namaAkun"
                            name=""></div>
                </div>
                <div class="row">
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>Username</strong></label><input class="form-control" placeholder="Boleh Kosong"
                                type="text" id="edit_username" name=""></div>
                    </div>
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="country"><strong>
                                    Password</strong></label><input class="form-control" type="text" id="edit_password"
                                placeholder="" name=""></div>
                    </div>
                </div>               
                <div class="row">
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>No HP</strong></label><input class="form-control" placeholder="Boleh Kosong"
                                type="text" id="edit_noHpAkun" name=""></div>
                    </div>
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>Tipe Akun</strong></label>
                            <select class="custom-select"  id="edit_tipeAkun">
                                <option selected>Choose...</option>
                                <option value="1">Kasir</option>
                            </select>
                        </div>
                    </div>
                    {{-- <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="country"><strong>
                                    Terakhir Diperbaharui</strong></label><input class="form-control" type="date"
                                id="edit_lu" placeholder="dd/mm/yyyy">
                        </div>
                    </div> --}}
                </div>
                <div class="mb-3"><label class="form-label" for="city"><strong>Alamat
                        </strong></label><textarea class="form-control" placeholder="Boleh Kosong" type="text"
                        id="edit_alamatAkun" name=""> </textarea></div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="update_akunBtn" type="button" class="btn btn-primary">Update Data</button>
        </div>
    </div>
@endsection

@section('modal_content_tambah')
    <div class="modal-content">
        <div class="modal-header card-header py-3">
            <p class="text-primary m-0 fw-bold">Tambah Data Akun</p>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
                <ul id="saveform_errList"></ul>
                <div class="row">
                    <div class="mb-3"><label class="form-label" for="city"><strong>Nama
                                Akun</strong></label><input class="form-control" placeholder="" type="text" id="add_namaAkun"
                            name=""></div>
                </div> 
                <div class="row">
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>Username</strong></label><input class="form-control" placeholder="Boleh Kosong"
                                type="text" id="add_username" name=""></div>
                    </div>
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="country"><strong>
                                    Password</strong></label><input class="form-control" type="password" id="add_password"
                                placeholder="" name=""></div>
                    </div>
                </div>              
                <div class="row">
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>No HP</strong></label><input class="form-control" placeholder="Boleh Kosong"
                                type="text" id="add_noHpAkun" name=""></div>
                    </div>
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>Tipe Akun</strong></label>
                            <select class="custom-select" id="add_tipeAkun">
                                <option selected>Choose...</option>
                                <option value="1">Kasir</option>
                            </select>
                        </div>
                    </div>
                    {{-- <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="country"><strong>
                                    Terakhir Diperbaharui</strong></label><input class="form-control" type="date"
                                id="edit_lu" placeholder="dd/mm/yyyy">
                        </div>
                    </div> --}}
                </div>
                <div class="mb-3"><label class="form-label" for="city"><strong>Alamat
                        </strong></label><textarea class="form-control" placeholder="Boleh Kosong" type="text"
                        id="add_alamatAkun" name=""> </textarea></div>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" data-bs-target="" data-bs-toggle="" data-bs-dismiss=""
                    id="add_data_akun">Add data</button>
            </div>
        </div>
    </div>
@endsection

@section('modal_content_hapus')
    <div class="modal-content">
        <div class="modal-header card-header py-3">
            <p class="text-primary m-0 fw-bold">Hapus Data Akun</p>
        </div>
        <div class="modal-body">
            <input type="hidden" id="delete_DAkun_id">
            <text>Apakah Anda Yakin Untuk Menghapus Data Ini?</text>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-bs-target="" data-bs-toggle="" data-bs-dismiss=""
                id="delete_data_akun">Delete Data</button>
        </div>
    </div>
@endsection
