@extends('layouts.modal')

@section('modal_content_tabel')
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header crd-header py-3">
            <p class="text-primary m-0 fw-bold">Detail Data Penjualan</p>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg">
                    <div class="mb-3"><label class="form-label" for="city"><strong>Nomor Nota
                                :</strong></label><input class="form-control" placeholder="" type="text"
                            id="detailNotaNomorNota" name="" disabled></div>
                </div>
                <div class="col-lg">
                    <div class="mb-3"><label class="form-label" for="city"><strong>Nama Pembeli
                                :</strong></label><input class="form-control" placeholder="" type="text"
                            id="detailNotaNamaPembeli" name="" disabled></div>
                </div>
            </div>
            <table class="table table-bordered" id="tabelDetailPenjualan" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Nama Barang</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Sub Total</th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr class="text-center">
                        <td><strong>#</strong></td>
                        <td><strong>Nama Barang</strong></td>
                        <td><strong>Qty</strong></td>
                        <td><strong>Harga</strong></td>
                        <td><strong>Sub Total</strong></td>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
