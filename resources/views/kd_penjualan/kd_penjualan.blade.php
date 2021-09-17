@extends('layouts.main')
@extends('kd_penjualan.modalPenjualan')
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
                <p class="text-primary m-0 fw-bold">Data Penjualan</p>
            </div>
            <div class="card-body">
                <div class="table-responsive table mt-2 mb-3 table-striped" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table table-bordered" id="tabelPenjualan">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Nomor Nota</th>
                                <th>Nama Pembeli</th>
                                <th>Total Pembelian</th>
                                <th><i class="fa fa-pencil-square-o fa-sm"></i>
                                    / <i class="fa fa-trash-o fa-sm">
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <td>#</td>
                                <td>Nomor Nota</td>
                                <td>Nama Pembeli</td>
                                <td>Total Pembelian</td>
                                <td><i class="fa fa-pencil-square-o fa-sm"></i>
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
                </div>
            </div>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
                <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"
                                integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                <script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
                <script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
                <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
                <script src="{{ asset('toastr/toastr.min.js') }}"></script>
       
    @endsection
