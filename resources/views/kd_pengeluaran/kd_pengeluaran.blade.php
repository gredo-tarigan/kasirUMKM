@extends('layouts.main')
@extends('kd_pengeluaran.modalPengeluaran')
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
            <p class="text-primary m-0 fw-bold">Data Pengeluaran</p>
        </div>
        <div class="card-body">
            <div class="table-responsive table mt-2 mb-3 table-striped" id="dataTable">
                <table class="table table-bordered" id="tabelPengeluaran" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Nama Pengeluaran</th>
                            <th>Nominal Pengeluaran</th>
                            <th>Jenis Pengeluaran</th>
                            <th>Keterangan Pengeluaran</th>
                            <th {{-- class="update" style="display:none;" --}}><i class="fa fa-pencil-square-o fa-sm"></i>
                                / <i class="fa fa-trash-o fa-sm">
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <td><strong>#</strong></td>
                                <td><strong>Nama Pengeluaran</strong></td>
                                <td><strong>Nominal Pengeluaran</strong></td>
                                <td><strong>Jenis Pengeluaran</strong></td>
                                <td><strong>Keterangan Pengeluaran</strong></td>
{{--                                 <td class="update" style="display:none;"><strong>Date</strong></td>
 --}}                                <td {{-- class="update" style="display:none;" --}}><i class="fa fa-pencil-square-o fa-sm"></i>
                                    / <i class="fa fa-trash-o fa-sm">
                                </td>
                                <td></td>
                            </tr>
                        </tfoot>
                       {{--  @foreach ($data_pengeluaran as $index => $dsd_kdPengeluaran)
                        <tr>
                            <td>{{ $index +1}}</td>
                            <td>{{ $dsd_kdPengeluaran["ket_pengeluaran"] }}</td>
                            <td>{{ $dsd_kdPengeluaran["jenis_pengeluaran"] }}</td>
                            <td>{{ $dsd_kdPengeluaran["nominal_pengeluaran"] }}</td>
                            <td>{{ $dsd_kdPengeluaran["created_at"] }}</td>
                            <td style="white-space: nowrap; display:none;" class="text-center update">
                                <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="expenses/edit/{{ $dsd_kdPengeluaran->slug }}"><i class="fa fa-pencil-square-o fa-sm text-white-50"></i>&nbsp;Edit</a>                                    
                                <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" data-bs-toggle="modal" data-bs-target="#modalEdit" href=""><i class="fa fa-pencil-square-o fa-sm text-white-50"></i>&nbsp;Edit</a> 
                                <a class="btn btn-danger btn-sm d-none d-sm-inline-block" role="button" data-bs-toggle="modal" data-bs-target="#modalHapus" href=""><i class="fa fa-trash-o fa-sm text-white-50"></i>&nbsp;Hapus</a> 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong></strong></td>
                            <td class="text-center"><strong>Jumlah</strong></td>
                            <td><strong></strong></td>
                            <td>Rp1000.000</td>
                            <td><strong></strong></td>
                            <td class="update" style="display:none;"><strong></strong></td>
                        </tr>
                    </tfoot> --}}
                </table>
            </div>
            <div class="row mb-2">
                <div class="col-md-6 text-nowrap">
                    <div class="form-check form-switch toggle-text update_data">
                        <input class="form-check-input" type="checkbox" id="update_data">
                        <div><i class="fa fa-pencil-square-o fa-sm"></i> / <i class="fa fa-trash-o fa-sm"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">

                    <div><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" data-bs-toggle="modal" data-bs-target="#modalTambah" href="#"><i
                                class="fas fa-plus-square fa-sm text-white-50"></i>&nbsp;Tambah Data Pengeluaran</a></div>
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
        {{-- <script>
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
        </script> --}}
@endsection
