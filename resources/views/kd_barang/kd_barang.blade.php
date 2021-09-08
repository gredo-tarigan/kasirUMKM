@extends('layouts.main')
@extends('kd_barang.modalBarang')
@section('content')
    <!-- Untuk mendukung AJAX; Fitur Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
    <!-- END -->
    <div class="col-lg">
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold">Data Barang</p>
            </div>
            <div class="card-body">
{{--                 <div class="row">
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
                        <div class="text-md-end dataTables_filter" id="dataTable_filter"><label
                                class="form-label"><input type="search" class="form-control form-control-sm"
                                    aria-controls="dataTable" placeholder="Search"></label></div>
                    </div>
                </div> --}}
                <div class="table-responsive mt-2 mb-3 table-striped" id="dataTable">
                    <table class="table table-bordered" id="tabelBarang" style="width:100%">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Nama Barang</th>
                                <th>Harga Masuk</th>
                                <th>Harga Jual</th>
                                <th>Stok Barang</th>
                                <th {{-- class="update" style="display:none;" --}}>Supplier</th>
                                <th {{-- class="update" style="display:none;" --}}>Keterangan</th>
{{--                                 <th class="update" style="display:none;">Date</th>
 --}}                                <th {{-- class="update" style="display:none;" --}}><i class="fa fa-pencil-square-o fa-sm"></i>
                                    / <i class="fa fa-trash-o fa-sm">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($data_barang as $index => $dsd_kdBarang)
                                <tr class="text-center">
                                    <td>{{ $index + 1 }}</td>
                                    <td style="white-space: nowrap;">{{ $dsd_kdBarang->nama_barang }}</td>
                                    <td>{{ $dsd_kdBarang->hargamasuk_barang }}</td>
                                    <td>{{ $dsd_kdBarang->hargajual_barang }}</td>
                                    <td>{{ $dsd_kdBarang->stok_barang }}</td>
                                    <td class="update" style="display:none;">{{ $dsd_kdBarang->supplier_barang }}
                                    </td>
                                    <td class="update" style="display:none;">{{ $dsd_kdBarang->ket_barang }}</td>
                                    <td class="update" style="display:none;">
                                        {{ $dsd_kdBarang->updated_at->format('Y-m-d') }}</td>
                                    <td style="white-space: nowrap; display:none;" class="text-center update">
                                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button"
                                            href="goods/edit/{{ $dsd_kdBarang->slug }}"><i
                                                class="fa fa-pencil-square-o fa-sm text-white-50"></i>&nbsp;Edit</a>
                                        <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button"
                                            data-bs-toggle="modal" data-bs-target="#modalEdit" href="" id="" value=""><i
                                                class="fa fa-pencil-square-o fa-sm text-white-50"></i>&nbsp;Edit</a>
                                        <a class="btn btn-danger btn-sm d-none d-sm-inline-block" role="button"
                                            data-bs-toggle="modal" data-bs-target="#modalHapus" href="" value=""><i
                                                class="fa fa-trash-o fa-sm text-white-50"></i>&nbsp;Hapus</a>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <td><strong>#</strong></td>
                                <td><strong>Nama Barang</strong></td>
                                <td><strong>Harga Masuk</strong></td>
                                <td><strong>Harga Jual</strong></td>
                                <td><strong>Stok Barang</strong></td>
                                <td {{-- class="update" style="display:none;" --}}><strong>Supplier</strong></td>
                                <td {{-- class="update" style="display:none;" --}}><strong>Keterangan</strong></td>
{{--                                 <td class="update" style="display:none;"><strong>Date</strong></td>
 --}}                                <td {{-- class="update" style="display:none;" --}}><i class="fa fa-pencil-square-o fa-sm"></i>
                                    / <i class="fa fa-trash-o fa-sm">
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

                        <div><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" data-bs-toggle="modal"
                                data-bs-target="#modalTambah" href="#"><i
                                    class="fas fa-plus-square fa-sm text-white-50"></i>&nbsp;Tambah Data Barang</a></div>
                    </div>
                </div>
{{-- 
                <div class="row">
                    <div class="col-md-6 align-self-center">
                        <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of
                            27
                        </p>
                    </div>
                    <div class="col-md-6">
                        <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                            <ul class="pagination">
                                <li class="page-item disabled"><a class="page-link" href="#"
                                        aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span
                                            aria-hidden="true">»</span></a></li>
                            </ul>
                        </nav>
                    </div>
                </div> --}}

                <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
                <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                <script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
                <script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
                <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
                <script src="{{ asset('toastr/toastr.min.js') }}"></script>

                <!-- script toggle -->
            {{--     <script>
                    $(document).ready(function() {
                        $(".update_data input").on("change", function(e) {
                            const kaloCheck = e.currentTarget.checked;
                            if (kaloCheck) {
                                $(".update").show();
                            } else {
                                $(".update").hide();
                            }
                        });
                    });
                </script> --}}
                <!-- END -->
            @endsection
