@extends('layouts.main')
@extends('layouts.modal')
@section('content')
     <div class="card shadow">
        <div class="card-header py-3">
            <p class="text-primary m-0 fw-bold">Data Barang</p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 text-nowrap">
                    <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"><label class="form-label">Show&nbsp;<select class="d-inline-block form-select form-select-sm">
                                <option value="10" selected="">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>&nbsp;</label></div>
                </div>
                <div class="col-md-6">
                    <div class="text-md-end dataTables_filter" id="dataTable_filter"><label class="form-label"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></label></div>
                </div>
            </div>
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table my-0" id="dataTable">
                    <thead>
                        <tr class="text-center">
                            <th>No.</th>
                            <th>Nama Barang</th>
                            <th>Harga Masuk</th>
                            <th>Harga Jual</th>
                            <th>Stok Barang</th>
                            <th>Update Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_barang as $index => $dsd_kdBarang)
                        <tr class="text-center">
                            <td>{{ $index +1 }}</td>
                            <td>{{ $dsd_kdBarang->nama_barang }}</td>
                            <td>{{ $dsd_kdBarang->hargamasuk_barang }}</td>
                            <td>{{ $dsd_kdBarang->hargajual_barang }}</td>
                            <td>{{ $dsd_kdBarang->stok_barang}}</td>
                            <td style="white-space: nowrap;" class="text-center">
                                <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" href="goods/edit/{{ $dsd_kdBarang->slug}}"><i class="fa fa-pencil-square-o fa-sm text-white-50"></i>&nbsp;Edit</a>                                    
                                <a class="btn btn-danger btn-sm d-none d-sm-inline-block" role="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" href=""><i class="fa fa-trash-o fa-sm text-white-50"></i>&nbsp;Hapus</a> 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="text-center">
                            <td><strong>No.</strong></td>
                            <td><strong>Nama Barang</strong></td>
                            <td><strong>Harga Masuk</strong></td>
                            <td><strong>Harga Jual</strong></td>
                            <td><strong>Stok Barang</strong></td>
                            <td><strong>Update Data</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Showing 1 to 10 of 27</p>
                </div>
                <div class="col-md-6">
                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                        <ul class="pagination">
                            <li class="page-item disabled"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
@endsection

@section('modal_content')
    
@endsection
