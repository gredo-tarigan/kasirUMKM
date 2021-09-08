@extends('layouts.main')
@extends('kd_akun.modalAkun')
@section('content')
 <!-- Untuk mendukung AJAX; Fitur Laravel -->
 <meta name="csrf-token" content="{{ csrf_token() }}">
 <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
 <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
 <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
 <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
 <!-- END -->
<div class="col-lg">
     <div class="card shadow mb-3">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Data Akun</p>
        </div>
        <div class="card-body">
            <div class="table-responsive table mt-2 mb-3 table-striped" id="dataTable" >
                <table class="table table-bordered" id="tabelAkun" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>No. HP</th>
                            <th>Tipe Akun</th>
                            <th>Alamat</th>
                            <th class="update"><i class="fa fa-pencil-square-o fa-sm"></i> / <i
                                class="fa fa-trash-o fa-sm">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($data_akun_sementara as $index => $da_sem)
                        <tr>
                            <td>{{ $index +1 }}</td>
                            <td>
                                <a><img class="rounded-circle " width="30" height="30" 
                                    src="assets/img/avatars/{{ ($da_sem["jk_ak"]  === "Laki-Laki") ? 'avatar-male.jpg' :''}}{{ ($da_sem["jk_ak"]  === "Perempuan") ? 'avatar-female.jpg' :''}}"></a>
                            </td>
                            <td>
                                <a> {{ $da_sem->nama_ak }}</a>
                            </td>
                            </td>
                            <td>{{ $da_sem->alamat_ak }}</td>
                            <td class="text-center">{{ 
                            
                            $years = \Carbon\Carbon::parse($da_sem->tgllahir_ak)->age;
                            
                            }}</td>
                            <td class="text-center">{{ $da_sem->jabatan_ak }}</td>
                            <td class="text-center">{{ $da_sem->username }}</td>
                            <td style="white-space: nowrap; update" class="text-center" style="display:none;">
                                <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="account/edit/{{ $da_sem->username }}" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-pencil-square-o fa-sm text-white-50"></i>&nbsp;Edit</a>                                    
                                <a class="btn btn-danger btn-sm d-none d-sm-inline-block" role="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-trash-o fa-sm text-white-50"></i>&nbsp;Hapus</a> 
                            </td>
                        </tr>
                        @endforeach --}}
                    </tbody>
                    <tfoot>
                        <tr class="text-center">
                            <td>#</td>
                            <td>Nama</td>
                            <td>Username</td>
                            <td>Password</td>
                            <td>No. HP</td>
                            <td>Tipe Akun</td>
                            <td>Alamat</td>
                            <td class="update"><i class="fa fa-pencil-square-o fa-sm"></i> / <i
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

                    <div><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="" data-bs-toggle="modal"
                        data-bs-target="#modalTambah"><i
                                class="fa fa-user-plus fa-sm text-white-50"></i>&nbsp;Tambah Akun</a></div>
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
       {{--  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
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
        </script> --}}
@endsection
