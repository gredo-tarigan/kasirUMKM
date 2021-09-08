@extends('layouts.modal')

@section('modal_content')
<div class="modal-content">
    <div class="modal-header card-header py-3">
        <p class="text-primary m-0 fw-bold">Edit Data Pengeluaran</p>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form>
            <ul id="updateform_errList"></ul>
            <div class="row">
                <input type="hidden" id="edit_DPeng_id">
                <div class="mb-3"><label class="form-label" for="city"><strong>Nama
                            Pengeluaran</strong></label><input class="form-control" placeholder="" type="text"
                        id="edit_np" name="city"></div>
            </div>
            <div class="row">
                <div class="col-lg">
                    <div class="mb-3"><label class="form-label" for="city"><strong>Nominal
                                Pengeluaran</strong></label><input class="form-control" placeholder="" type="text"
                            id="edit_nomp" name="city"></div>
                </div>
                <div class="col-lg">
                    <div class="mb-3"><label class="form-label" for="country"><strong>
                       Kategori Pengeluaran</strong></label><input class="form-control" type="text" id="edit_katp" placeholder="">
                    </div>
                </div>

            </div>
            <div class="mb-3"><label class="form-label" for="city"><strong>Keterangan
                    </strong></label><textarea class="form-control" placeholder="(Boleh Kosong)" type="text" id="edit_kp" name="city"></textarea>
                </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button id="update_pengeluaranBtn" type="button" class="btn btn-primary">Update data</button>
    </div>
</div>
@endsection

@section('modal_content_tambah')
    <div class="modal-content">
        <div class="modal-header card-header py-3">
            <p class="text-primary m-0 fw-bold">Tambah Data Pengeluaran</p>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form>
                <ul id="saveform_errList"></ul>
                <div class="row">
                    <div class="mb-3"><label class="form-label" for="city"><strong>Nama
                                Pengeluaran</strong></label><input class="form-control" placeholder="" type="text"
                            id="add_np" name="city"></div>
                </div>
                <div class="row">
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>Nominal
                                    Pengeluaran</strong></label><input class="form-control" placeholder="" type="text"
                                id="add_nomp" name="city"></div>
                    </div>
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="country"><strong>
                           Kategori Pengeluaran</strong></label><input class="form-control" type="text" id="add_kp" placeholder="">
                        </div>
                    </div>

                </div>
                <div class="mb-3"><label class="form-label" for="city"><strong>Keterangan
                        </strong></label><textarea class="form-control" placeholder="(Boleh Kosong)" type="text" id="add_katp" name="city"></textarea>
                    </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-bs-target="" data-bs-toggle=""
                data-bs-dismiss="" id="add_data_pengeluaran">Add data</button>
        </div>
    </div>
@endsection

@section('modal_content_hapus')
    <div class="modal-content">
        <div class="modal-header card-header py-3">
            <p class="text-primary m-0 fw-bold">Hapus Data Pengeluaran</p>
        </div>
        <div class="modal-body">
            <input type="hidden" id="delete_DPeng_id">
            <text>Apakah Anda Yakin Untuk Menghapus Data Ini?</text>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-bs-target="" data-bs-toggle="" data-bs-dismiss=""
                id="delete_data_pengeluaran">Delete Data</button>
        </div>
    </div>
@endsection