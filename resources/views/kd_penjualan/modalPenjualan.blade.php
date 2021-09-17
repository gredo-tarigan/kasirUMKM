@extends('layouts.modal')

@section('modal_content')
    <div class="modal-content">
        <div class="modal-header crd-header py-3">
            <p class="text-primary m-0 fw-bold">Edit Data Penjualan</p>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered" id="tabelEditPenjualan" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Nama Barang</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Sub Total</th>
                        <th><i class="fa fa-trash-o fa-sm"></i>
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
                        <td><i class="fa fa-trash-o fa-sm"></i>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button id="update_akunBtn" type="button" class="btn btn-primary">Update Data</button>
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
