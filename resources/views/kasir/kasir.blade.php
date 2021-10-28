@extends('layouts.main')
@extends('kasir.modalKasir')
@extends('layouts.modalAkunUser')
@section('content')
    <!-- Untuk mendukung AJAX; Fitur Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
    <!-- END -->
    <!-- Bootstrap select live search -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
    <!-- END -->
    <div class="col-lg">
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold">Nota Barang</p>
            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-lg">
                            <div class="mb"><label class="form-label" for="city"><strong>Nama
                                        Pembeli</strong></label><input class="form-control" placeholder="Boleh Kosong"
                                    type="text" id="nama_pembeli" name="city"></div>
                        </div>
                        <div class="col-lg">
                            <div class="mb"><label class="form-label"><strong>
                                        No. Nota</strong></label><input class="form-control" type="text" id="no_nota"
                                    placeholder="" value="" disabled></div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb" style="text-align: center;">
                                <div><i class="fa fa-calendar fa-2x mb-1"></i></div>
                                <label class="form-label" for="address">
                                    <p>{{ $carbon_today->isoFormat('dddd') }} <br>
                                        {{ $carbon_today->isoFormat('D MMMM Y') }}</p>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-check form-switch toggle-text edit_delete">
                        <input class="form-check-input" type="checkbox">
                        <div><i class="fa fa-trash-o fa-sm"></i>
                        </div>
                    </div>
                    <div class="mb-3" style="width:100%">
                        <div class="table-responsive table-striped" id="dataTable">
                            <table class="table table-bordered" id="tabelTempPenjualan" style="width:100%">
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
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg" style="text-align: right"><label class="form-label mt-1"
                                for="city"><strong>Total Pembelian :</strong></label></div>
                        <div class="col-lg-3" style="text-align: center"><label class="form-label" for="city"
                                style="font-size:20px;">
                                <p id="total_pembelian"> {{-- @currency_IDR($total_pembelian) --}}</p>
                            </label></div>
                    </div>
                    <div class="d-flex justify-content-end mb-3"><button
                            class="btn btn-primary btn-sm d-none d-sm-inline-block" type="submit" id="btnNota"><i
                                class="fa fa-shopping-cart fa-sm text-white-50"></i>&nbsp;&nbsp;Pembelian
                            Selesai</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold">Input Barang</p>
            </div>
            <div class="card-body">
                <form>
                    <ul id="saveform_errList"></ul>
                    <div class="mb-3"><label class="form-label" for="address"><strong>Nama
                                Barang</strong></label>
                        {{-- <input class="form-control" placeholder=""
                            id="exampleFormControlTextarea1"> --}}
                        <select class="selectpicker form-control mb-3" data-live-search="true" id="selectNamaBarang">
                            @foreach ($option_select as $option)
                                <option id="option_data" data-harga-barang="{{ $option->harga_jual }}"
                                    data-id-barang="{{ $option->id }}" value=""
                                    data-kategori-penjualan="{{ $option->kategori_penjualan_id }}" data-stok-database="{{ $option->stok }}">
                                    {{ $option->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div id="content"> </div>

                    <div class="form-check form-switch toggle-text switch">
                        <input class="form-check-input" type="checkbox" id="">

                        <p>Harga Grosir</strong></p>
                    </div>
                    <div class="row">
                        <div class="row">
                            <input type="hidden" class="form-control" type="text" placeholder="" id="fInput_id_Barang"
                                value="">
                            <input type="hidden" class="form-control" type="text" placeholder="" id="fInput_penjualanId"
                                value="">
                            <input type="hidden" class="form-control" type="text" placeholder="" id="fInput_akunId"
                                value="">
                            <input type="hidden" class="form-control" type="text" placeholder="" id="fInput_notaId"
                                value="">
                            <input type="hidden" class="form-control" type="text" placeholder="" id="fInput_subTotal"
                                value="">
                            <input type="hidden" class="form-control" type="text" placeholder="" id="fInput_hargaJadi"
                                value="">
                            <input type="hidden" class="form-control" type="text" placeholder="" id="fInput_massaPieces"
                                value="">
                            <div class="mb-3"><label class="form-label"
                                    for="address"><strong>Harga</strong></label>
                                <input class="form-control" type="text" data-cadangan-value="" placeholder=""
                                    aria-label="input example" disabled id="harga" required>
                            </div>
                        </div>
                        <div class="row">
                            <div><label class="form-label"><strong class="ganti_downg">Nominal
                                        / Kuantitas</strong></label>
                                <input class="form-control" type="text" id="input_perhitungan" placeholder="" value=""
                                    required>
                            </div>
                            <div class="card" id="tombol_harga">
                                <div class="btn-toolbar mb-1 mt-1"
                                    style=" display: flex;
                                                                                                                                                    justify-content: center;
                                                                                                                                                    align-items: center;">

                                   {{--  @foreach ($woy as $item)
                                    <button type="button" class="btn btn-success btn-sm yoman"
                                        style="width: 47%;  margin: 2.5px; color: white;" value="10000">Rp10.000</button>
                                    @endforeach --}}
                                    <button type="button" id="btnSubmit" class="btn btn-info btn-sm yoman" data-val="5000"
                                        style="width: 47%; margin: 2.5px; color: white;" >Rp5000</button>
                                    <button type="button" id="btnCancel" class="btn btn-info btn-sm yoman" data-val="7500"
                                        style="width: 47%;  margin: 2.5px; color: white;" >Rp7500</button>
                                    <button type="button" id="btnSubmit" class="btn btn-success btn-sm yoman" data-val="10000"
                                        style="width: 47%;  margin: 2.5px; color: white;" >Rp10.000</button>
                                    <button type="button" id="btnSubmit" class="btn btn-success btn-sm yoman" data-val="15000"
                                        style="width: 47%;  margin: 2.5px; color: white;" >Rp15.000</button>
                                    {{-- <button type="button" id="btnCancel" class="btn btn-success btn-sm"
                                        style="width: 47%;  margin: 2.5px; color: white;"><i
                                            class="fa fa-pencil-square-o fa-sm"></i></button> --}}
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-5 mb-3">
                            <button class="btn btn-primary btn-sm" id="btnTempPenjualan"><i
                                    class="fa fa-cart-plus fa-sm text-white-50"></i>&nbsp;&nbsp;Tambahkan</button>
                        </div>
                    </div>
                </form>
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
    <script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatable/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('toastr/toastr.min.js') }}"></script>
    {{-- <script>
        $(document).ready(function() {
            $(".switch input").on("change", function(e) {
                const isOn = e.currentTarget.checked;
                if (isOn) {
                    //$(".hideme").hide();
                    $('#harga').prop('disabled', false); // Biar bisa masukin harga manual
                } else {
                    //$(".hideme").show();

                    $('#harga').prop('disabled', true);
                }
            });

        });
    </script> --}}
    <script>
        $(document).ready(function() {
            $(".switch2 input").on("change", function(e) {
                const isOn = e.currentTarget.checked;

                if (isOn) {
                    $(".hideme3").show();
                } else {
                    $(".hideme3").hide();
                }
            });
        });
    </script>

    {{-- <!-- ...or, you may also directly use a CDN :-->
    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
    <!-- ...or -->
    <script src="https://unpkg.com/autonumeric"></script> --}}
@endsection
