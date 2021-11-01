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
                                    Kategori Pengeluaran</strong></label>
                            <select class="form-select" aria-label="Default select example" id="edit_katp">
                                @foreach ($kategori_pengeluaran as $item)
                                    <option value="{{ $item->id }}">{{ $item->kategori_pengeluaran }}</option>
                                @endforeach
                            </select>
                            {{-- <input class="form-control" type="text" id="edit_katp" placeholder=""> --}}
                        </div>
                    </div>

                </div>
                <div class="mb-3"><label class="form-label" for="city"><strong>Keterangan
                        </strong></label><textarea class="form-control" placeholder="(Boleh Kosong)" type="text"
                        id="edit_kp" name="city"></textarea>
                </div>

            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="update_pengeluaranBtn" type="button" class="btn btn-primary">Update data</button>
        </div>
    </div>
@endsection

@section('modal_content2')
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header card-header py-3">
                <p class="text-primary m-0 fw-bold">Edit Jenis Pengeluaran</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <ul id="updateform_errList2"></ul>
                    <div class="row">
                        <input type="hidden" id="edit_DJenisPeng_id">
                        <div class="mb-3"><label class="form-label" for="city"><strong>Jenis
                                    Pengeluaran</strong></label><input class="form-control" placeholder="" type="text"
                                id="edit_jenisPengeluaran" name="city"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="close_jenisPengeluaranBtn" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button id="update_jenisPengeluaranBtn" type="button" class="btn btn-primary">Update data</button>
            </div>
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
                                Pengeluaran</strong></label><input class="form-control" placeholder="Nama Pengeluaran.."
                            type="text" id="add_np" name="city"></div>
                </div>
                <div class="row">
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>Nominal
                                    Pengeluaran</strong></label><input class="form-control"
                                placeholder="Nominal Pengeluaran.." type="text" id="add_nomp" name="city"></div>
                    </div>
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="country"><strong>
                                    Kategori Pengeluaran</strong></label>
                            <select class="form-select" aria-label="Default select example" id="add_katp">
                                @foreach ($kategori_pengeluaran as $item)
                                    <option value="{{ $item->id }}">{{ $item->kategori_pengeluaran }}</option>
                                @endforeach
                            </select>
                            {{-- <input class="form-control" type="text" id="add_katp" placeholder=""> --}}
                        </div>
                    </div>

                </div>
                <div class="mb-3"><label class="form-label" for="city"><strong>Keterangan
                        </strong></label><textarea class="form-control" placeholder="" type="text"
                        id="add_kp" name="city"></textarea>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" data-bs-target="" data-bs-toggle="" data-bs-dismiss=""
                id="add_data_pengeluaran">Add data</button>
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

@section('modal_content_hapus2')
    <div class="modal-content">
        <div class="modal-header card-header py-3">
            <p class="text-primary m-0 fw-bold">Hapus Jenis Pengeluaran</p>
        </div>
        <div class="modal-body">
            <input type="hidden" id="delete_DJenisPeng_id">
            <text>Apakah Anda Yakin Untuk Menghapus Data Ini? <br><br> Pastikan sebelumnya tidak ada data pengeluaran yang
                terhubung dengan jenis pengeluaran ini untuk menghindari kerusakan pada data yang sudah ada.</text>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                id="closeBtnJenisPengeluaran">Close</button>
            <button type="button" class="btn btn-primary" data-bs-target="" data-bs-toggle="" data-bs-dismiss=""
                id="delete_jenis_pengeluaran">Delete Data</button>
        </div>
    </div>
@endsection

@section('modal_content_tabel')
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header card-header py-3">
                <p class="text-primary m-0 fw-bold">Kelola Jenis Pengeluaran</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <ul id="saveform_errListJenisPengeluaran"></ul>
                    <div class="row">
                        <label class="form-label" for="city"><strong>Jenis
                                Pengeluaran</strong></label>
                        <div class="col-lg-9"><input class="form-control" placeholder="Add Jenis Pengeluaran.."
                                type="text" id="add_jenisPengeluaran" name="city"></div>
                        <div class="col-lg">
                            <button type="button" class="btn btn-primary sm" data-bs-target="" data-bs-toggle=""
                                data-bs-dismiss="" id="add_data_jenisPengeluaran">Tambah</button>
                        </div>
                    </div>
                    <div class="table-responsive table mt-2 mb-3 table-striped" id="dataTable">
                        <table class="table table-bordered" id="tabelJenisPengeluaran" style="width:100%">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Jenis Pengeluaran</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <tr class="text-center">
                                    <td><strong>#</strong></td>
                                    <td><strong>Jenis Pengeluaran</strong></td>
                                    <td>Action</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.1.1/js/dataTables.dateTime.min.js"></script>

    <script>

    </script>
@endsection
