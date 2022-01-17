@extends('layouts.main')
@extends('kd_barang.modalBarang')
@extends('layouts.modalAkunUser')
@section('content')
    <!-- Untuk mendukung AJAX; Fitur Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
    <!-- Bootstrap select live search -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
    <!-- END -->

    <!-- END -->
    <div class="col-lg- mb-3">
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold">Stock Opname Barang</p>
            </div>
            <div class="card-body">
                <ul id="saveform_errList"></ul>
                <div class="row  mt-3">
                    <div class="col-lg-3">
                        <div class="input-group mb-2">
                            <input class="form-control" placeholder="Tanggal Opname" type="text" id="tanggal_dipilih"
                                name="tanggal_dipilih" style="text-align: center;" autocomplete="off">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="mb-3">
                            <div class="input-group mb-2">
                                <button type="button" class="btn btn-primary" id="TampilkanStockOpname">Tampilkan</button>
                                <button type="button" class="btn btn-success text-white input-group-append"
                                    id="RefreshStockOpname">Refresh </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="mb-3"><label class="form-label" for="city"><strong>Nama
                                    Barang</strong></label><select class="selectpicker form-control mb-3"
                                data-live-search="true" id="selectBarangOpname" style="text-align: center;">
                                @foreach ($data_barang as $option)
                                    <option id="option_data" data-harga-barang="{{ $option->harga_jual }}"
                                        data-id-barang="{{ $option->id }}" value=""
                                        data-kategori-penjualan="{{ $option->kategori_penjualan_id }}"
                                        data-stok-database="{{ $option->stok }}"
                                        data-stok-awal="{{ $option->stok_awal }}"
                                        data-stok-nama="{{ $option->nama }}">
                                        {{ $option->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" class="form-control" type="text" placeholder="" id="FInput_IdBarang"
                            value="">
                        <input type="hidden" class="form-control" type="text" placeholder="" id="FInput_NamaBarang"
                            value="">
                        <input type="hidden" class="form-control" type="text" placeholder="" id="FInput_DataStokBarang"
                            value="">
                    </div>
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>
                                    Stok Sistem</strong></label>
                            <div class="input-group">
                                <input class="form-control" placeholder="" type="text" id="stok_sistem" name="" disabled>
                                <input class="form-control input-group-append col-lg-4 kategori_penjualan_class"
                                    placeholder="" type="text" id="" style="text-align: center;" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>
                                    Stok Fisik</strong></label>
                            <div class="input-group">
                                <input class="form-control" placeholder="" type="number" id="stok_fisik" name="" min="0">

                                <input class="form-control input-group-append col-lg-4 kategori_penjualan_class"
                                    placeholder="" type="text" id="" style="text-align: center;" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg">
                        <div class="mb-3"><label class="form-label" for="city"><strong>
                                    Stok Masuk</strong></label>
                            <div class="input-group">

                                <input class="form-control" placeholder="" type="number" id="stok_masuk" name="add_supb" min="0">

                                <input class="form-control input-group-append col-lg-4 kategori_penjualan_class"
                                    placeholder="" type="text" id="" style="text-align: center;" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="mb-3" style="position:relative;">
                            <div class="mb-2">
                                <button type="button" class="btn btn-primary" style="position: relative;
                                                                                        top: 32px;
                                                                                        "  id="buttonOpname" disabled="disabled"
                                    data-bs-toggle="modal" data-bs-target="#modalOpname"><i
                                        class="fas fa-plus-square fa-sm text-white-50"></i>
                                    Data
                                    Opname</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="row" style="float: right;">
                    <div class="mb-3 mt-1">
                        <button type="button" class="btn btn-primary"><i class="fas fa-plus-square fa-sm text-white-50"></i>
                            Tambah Data Stock Opname</button>
                    </div>
                </div> --}}
                <div class="table-responsive mt-3 mb-3 table-striped" id="dataTable">
                    <table class="table table-bordered" id="tabelStockOpname" style="width:100%">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th style="white-space: nowrap;">Nama Barang</th>
                                <th>Satuan</th>
                                <th>Stok Awal</th>
                                <th>Stok Keluar</th>
                                <th>Stok Masuk</th>
                                <th>Stok Sistem</th>
                                <th>Stok Fisik</th>
                                <th>Selisih</th>
                                <th>Keterangan</th>
                                <th>Periode</th>
                                <th>Tgl Opname</th>
                                <th {{-- class="update" style="display:none;" --}} class="not-export-col"><i class="fa fa-pencil-square-o fa-sm"></i> / <i class="fa fa-trash-o fa-sm"></i>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <td><strong>#</strong></td>
                                <td><strong>Nama Barang</strong></td>
                                <td><strong>Satuan</strong></td>
                                <td><strong>Stok Awal</strong></td>
                                <td><strong>Stok Keluar</strong></td>
                                <td><strong>Stok Masuk</strong></td>
                                <td><strong>Stok Sistem</strong></td>
                                <td><strong>Stok Fisik</strong></td>
                                <td><strong>Selisih</strong></td>
                                <td><strong>Keterangan</strong></td>
                                <td><strong>Periode</strong></td>
                                <td><strong>Tgl Opname</strong></td>
                                {{-- <td class="update" style="display:none;"><strong>Date</strong></td> --}} <td {{-- class="update" style="display:none;" --}}><i class="fa fa-pencil-square-o fa-sm"></i> / <i class="fa fa-trash-o fa-sm"></i>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="row mb-2">

                    <div class="col-md-5">
                        <div class="form-check form-switch toggle-text Opname">
                            <input class="form-check-input" type="checkbox" id="Mode_Kustom">
                            <div><i class="fa fa-pencil-square-o fa-sm"></i> / <i class="fa fa-trash-o fa-sm"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col text-md-end">

                        <ul class="btn-group">
                            @if (auth()->user()->kategori_akun_id == 2)
                            <button type="button" class="btn btn-success dropdown-toggle text-white" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><i
                                    class="fa fa-download fa-sm text-white-50"></i>&nbsp;
                                Generate Laporan
                            </button>
                            @endif
                            <ul class="dropdown-menu">
                                <a class="dropdown-item printOpname" href="#">Export CSV</a>
                                <a class="dropdown-item printOpname" href="#">Export Excel</a>
                                <a class="dropdown-item printOpname" href="#">Export PDF</a>
                            </ul>
                        </ul>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-">
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold">Data Barang</p>
            </div>
            <div class="card-body">
                {{-- <div class="row">
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

                <div class="table-responsive mt-3 mb-3 table-striped" id="dataTable">
                    <table class="table table-bordered" id="tabelBarang" style="width:100%">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Nama Barang</th>
                                <th>Harga Masuk</th>
                                <th>Harga Jual</th>
                                <th>Stok Barang</th>
                                <th {{-- class="update" style="display:none;" --}}>Supplier</th>
                                {{-- <th class="update" style="display:none;">Date</th> --}} <th {{-- class="update" style="display:none;" --}} class="not-export-col"><i
                                        class="fa fa-pencil-square-o fa-sm"></i>
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
                                {{-- <td class="update" style="display:none;"><strong>Date</strong></td> --}} <td {{-- class="update" style="display:none;" --}}><i
                                        class="fa fa-pencil-square-o fa-sm"></i>
                                    / <i class="fa fa-trash-o fa-sm">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>


                {{-- <div class="row">
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

                <div class="row mb-2">

                    <div class="col-md-5">
                        <div class="form-check form-switch toggle-text update_data">
                            <input class="form-check-input" type="checkbox" id="Mode_Kustom">
                            <div><i class="fa fa-pencil-square-o fa-sm"></i> / <i class="fa fa-trash-o fa-sm"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col text-md-end">

                        <ul class="btn-group">
                            @if (auth()->user()->kategori_akun_id == 2)
                            <button type="button" class="btn btn-success dropdown-toggle text-white" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><i
                                    class="fa fa-download fa-sm text-white-50"></i>&nbsp;
                                Generate Laporan
                            </button>
                            @endif
                            <ul class="dropdown-menu">
                                <a class="dropdown-item print" href="#">Export CSV</a>
                                <a class="dropdown-item print" href="#">Export Excel</a>
                                <a class="dropdown-item print" href="#">Export PDF</a>                               
                            </ul>
                        </ul>

                        <ul class="btn btn-primary" role="button" data-bs-toggle="modal" data-bs-target="#modalTambah"
                            href="#"><i class="fas fa-plus-square fa-sm text-white-50"></i>&nbsp;Data Barang</ul>
                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Bootstrap select live search -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
    <!-- END -->

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>



    <!-- Untuk Datepicker -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
    <!-- END -->
    <script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>

    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js" type="text/javascript"></script>
    <!-- script toggle -->
    {{-- <script>
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
