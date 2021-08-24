@extends('layouts.main')
@section('content')
    <div class="col-lg">
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold">Nota Barang</p>
            </div>
            <div class="card-body">
                <form>
                    <div class="row">
                        <div class="col-lg">
                            <div class="mb-3"><label class="form-label" for="city"><strong>Nama
                                        Pembeli</strong></label><input class="form-control" placeholder="Boleh Kosong"
                                    type="text" id="city" name="city"></div>
                        </div>
                        <div class="col-lg">
                            <div class="mb-3"><label class="form-label" for="country"><strong>
                                        No. Nota</strong></label><input class="form-control" type="text" id="country"
                                    placeholder="XXX" name="country" disabled></div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mt-3" style="text-align: center;">
                                <div><i class="fa fa-calendar fa-2x"></i></div>
                                <label class="form-label" for="address">
                                    <p> 22 Agustus 2021</p>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3" style="height: 20rem; width: 100%">
                        <div class="table-responsive table mt-2" id="dataTable" role="grid"
                            aria-describedby="dataTable_info">
                            <table class="table my-0" id="dataTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Nama Barang</th>
                                        <th>Berat</th>
                                        <th>Nom. Pembelian</th>
                                        <th><i class="fa fa-pencil-square-o fa-sm"></i> / <i class="fa fa-trash-o fa-sm">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-center">
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="white-space: nowrap;" class="text-center">
                                            <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button"
                                                href=""><i class="fa fa-pencil-square-o fa-sm text-white-50"></i></a>
                                            <a class="btn btn-danger btn-sm d-none d-sm-inline-block" role="button"
                                                data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i
                                                    class="fa fa-trash-o fa-sm text-white-50"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-lg" style="text-align: right"><label class="form-label mt-1"
                                for="city"><strong>Total Pembelian :</strong></label></div>
                        <div class="col-lg-3" style="text-align: center"><label class="form-label" for="city"
                                style="font-size:20px;">
                                <p>Rp 100.000</p>
                            </label></div>
                    </div>
                    <div class="d-flex justify-content-end mb-3"><button
                            class="btn btn-primary btn-sm d-none d-sm-inline-block" type="submit"><i
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
                    <div class="mb-3"><label class="form-label" for="address"><strong>Nama Barang</strong></label><input
                            class="form-control" placeholder="" id="exampleFormControlTextarea1"></div>



                    <div class="form-check form-switch toggle-text"><input class="form-check-input" type="checkbox"
                            id="formCheck-1"><label class="form-check-label" for="formCheck-1">
                            <p>Mode Kustom Harga</strong></p>
                            <span>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3"><label class="form-label" for="address"><strong>Harga</strong></label>
                                        <input class="form-control" type="text" placeholder="50000"
                                            aria-label="Disabled input example" disabled>
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="mb-2"><label class="form-label" for="address"><strong>Nominal
                                                Pembelian</strong></label>
                                        <input class="form-control" type="text" id="address" placeholder="" name="address">
                                    </div>
                                    <div class="card">
                                        <div class="btn-toolbar mb-1 mt-1" style=" display: flex;
                                                            justify-content: center;
                                                            align-items: center;">
                                            <button type="button" id="btnSubmit" class="btn btn-info btn-sm"
                                                style="width: 47%; margin: 2.5px; color: white;">Rp5000</button>
                                            <button type="button" id="btnCancel" class="btn btn-info btn-sm"
                                                style="width: 47%;  margin: 2.5px; color: white;">Rp7500</button>
                                            <button type="button" id="btnSubmit" class="btn btn-success btn-sm"
                                                style="width: 47%;  margin: 2.5px; color: white;">Rp10.000</button>
                                            <button type="button" id="btnCancel" class="btn btn-success btn-sm"
                                                style="width: 47%;  margin: 2.5px; color: white;"><i
                                                    class="fa fa-pencil-square-o fa-sm"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </span>
                            <span class="hidden">
                                <div class="row ">
                                    <div class="col-lg-4">
                                        <div class="mb-3"><label class="form-label" for="address"><strong>Test</strong></label>
                                            <input class="form-control" type="text" placeholder="50000"
                                                aria-label="Disabled input example" disabled>
                                        </div>
                                    </div>
                                    <div class="col-lg">
                                        <div class="mb-2"><label class="form-label" for="address"><strong>Nominal
                                                    Pembelian</strong></label>
                                            <input class="form-control" type="text" id="address" placeholder="" name="address">
                                        </div>
                                        
                                    </div>
                                </div>
                            </span>
                    </div>


                    

                    
                    <div class="d-flex justify-content-end mt-5 mb-3"><button
                            class="btn btn-primary btn-sm d-none d-sm-inline-block" type="submit"><i
                                class="fa fa-cart-plus fa-sm text-white-50"></i>&nbsp;&nbsp;Tambahkan</button></div>
                </form>
            </div>
        </div>
    </div>
    {{-- <div class="form-check form-switch toggle-text"><input class="form-check-input" type="checkbox"
        id="formCheck-1"><a class="toggle-text2" data-toggle="collapse" href="#collapseExample">
            {{-- See <span>more</span><span class="hidden2">less</span>...
        </a> --}}
{{-- </div> --}}
{{-- <a class="toggle-text1" data-toggle="collapse" href="#collapseExample">
    See <span>more</span><span class="hidden1">less</span>...
</a> --}} 

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script>
        $('.hidden').removeClass('hidden').hide();
        $('.toggle-text').click(function() 
        {
            $(this).find('span').each(function() {
                $(this).toggle();
            });
        });
    </script>

@endsection
