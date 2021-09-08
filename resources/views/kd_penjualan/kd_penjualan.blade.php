@extends('layouts.main')
@extends('kd_penjualan.notifModalPenjualan')
@section('content')
<div class="col-lg">
    <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Data Penjualan</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 text-nowrap">
                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label
                            class="form-label">Show&nbsp;<select class="d-inline-block form-select form-select-sm">
                                <option value="10" selected="">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>&nbsp;</label></div>
                </div>
                <div class="col-md-6">
                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input
                                type="search" class="form-control form-control-sm" aria-controls="dataTable"
                                placeholder="Search"></label></div>
                </div>
            </div>       
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Nama Barang</th>
                            <th>Tanggal Pembelian</th>
                            <th>Total Pembelian</th>
                            <th class="update" style="display:none;"><i class="fa fa-pencil-square-o fa-sm"></i> / <i
                                class="fa fa-trash-o fa-sm">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_penjualan as $index => $dsd_kdPenjualan)
                            <tr class="text-center">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $dsd_kdPenjualan['namabarang_penjualan'] }}</td>
                                <td>{{ $dsd_kdPenjualan['created_at'] }}</td>
                                <td>{{ $dsd_kdPenjualan['total_pengeluaran'] }}</td>
                                <td style="white-space: nowrap; display:none;" class="text-center update">
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button"
                                        href="sales/edit/{{ $dsd_kdPenjualan->slug }}"><i
                                            class="fa fa-pencil-square-o fa-sm text-white-50"></i>&nbsp;Edit</a>
                                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button"
                                        href="" data-bs-toggle="modal" data-bs-target="#modalEdit"><i
                                            class="fa fa-pencil-square-o fa-sm text-white-50"></i>&nbsp;Edit</a>
                                    <a class="btn btn-danger btn-sm d-none d-sm-inline-block" role="button"
                                        data-bs-toggle="modal" data-bs-target="#modalHapus" href=""><i
                                            class="fa fa-trash-o fa-sm text-white-50"></i>&nbsp;Hapus</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-center"><strong>Jumlah</strong></td>
                            <td><strong></strong></td>
                            <td><strong></strong></td>
                            <td class="text-center">Rp1000.000</td>
                            <td class="update text-center" style="display:none;"><i class="fa fa-pencil-square-o fa-sm"></i> / <i
                                class="fa fa-trash-o fa-sm">
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row mb-2">
                <div class="col-md-6 text-nowrap">
                    <div class="form-check form-switch toggle-text update_data">
                        <input class="form-check-input" type="checkbox" id="Mode_Kustom">
                        <div><i class="fa fa-pencil-square-o fa-sm"></i> / <i class="fa fa-trash-o fa-sm"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">

                    <div><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" data-bs-toggle="modal" data-bs-target="#modalTambah" href=""><i
                                class="fas fa-plus-square fa-sm text-white-50"></i>&nbsp;Tambah Data Penjualan</a></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of
                        27
                    </p>
                </div>
                <div class="col-md-6">
                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                        <ul class="pagination">
                            <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span
                                        aria-hidden="true">«</span></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span
                                        aria-hidden="true">»</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script>
            $(document).ready(function() {
                $(".update_data input").on("change", function(e) {
                    const isOn = e.currentTarget.checked;

                    if (isOn) {
                        $(".update").show();
                    } else {
                        $(".update").hide();
                    }
                });
            });
        </script>
    @endsection
