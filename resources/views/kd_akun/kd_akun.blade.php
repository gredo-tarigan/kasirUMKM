@extends('layouts.main')

@section('content')
     <div class="card shadow mb-3">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Data Akun</p>
        </div>
        <div class="card-body">
            <div class="table-responsive table" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr class="text-center">
                            <th>No.</th>
                            <th colspan="2">Nama</th>
                            <th>Alamat</th>
                            <th>Umur</th>
                            <th>Posisi</th>
                            <th>Username</th>
                            <th>Update Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_akun_sementara as $index => $da_sem)
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
                            <td style="white-space: nowrap;" class="text-center">
                                <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="account/edit/{{ $da_sem->username }}" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-pencil-square-o fa-sm text-white-50"></i>&nbsp;Edit</a>                                    
                                <a class="btn btn-danger btn-sm d-none d-sm-inline-block" role="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-trash-o fa-sm text-white-50"></i>&nbsp;Hapus</a> 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row mb-3">
                <div class="d-flex justify-content-end">
                    <div><a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="#"><i class="fa fa-user-plus fa-sm text-white-50"></i>&nbsp;Tambah Akun</a></div>
                </div>
            </div>
        </div>
@endsection
