@extends('layouts.main')
{{-- @extends('layouts.modal') --}}
@extends('layouts.modalAkunUser')
@section('content')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
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
    <div class="d-sm-flex justify-content-between align-items-center mb-4">
        <h3 class="text-dark mb-0">Dashboard</h3>{{-- <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button"
            href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a> --}}
    </div>
    <div class="col-lg">
        <div class="row">
            <div class="col-lg mb-3">
                <div class="card shadow border-start-primary py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-primary fw-bold text-xs mb-1"><span>Penjualan Hari
                                        Ini</span></div>
                                <div class="text-dark fw-bold h5 mb-0"><span>
                                        @foreach ($penjualan_today as $item)
                                            Rp {{ number_format($item->profit, 0, '', '.') }}
                                        @endforeach
                                    </span></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-calendar fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg mb-3">
                <div class="card shadow border-start-success py-2">
                    <div class="card-body">
                        <div class="row align-items-center no-gutters">
                            <div class="col me-2">
                                <div class="text-uppercase text-success fw-bold text-xs mb-1"><span>Pelanggan Hari
                                        Ini</span></div>
                                <div class="text-dark fw-bold h5 mb-0"><span>
                                        {{ $pelanggan_today }} Orang
                                    </span></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg">
            <div class="card shadow">
                <div class="card-header py-3">
                    <p class="text-primary m-0 fw-bold chart-title">Penjualan 1 Minggu Terakhir</p>
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <canvas id="myChart" style="width: 100%; height: 315px;"></canvas>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg">
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary text-center m-0 fw-bold">Riwayat Transaksi</p>
            </div>
            <div class="card-body d-flex align-items-end flex-column" style="height: 31rem;">
                <div class="col-12">
                    @foreach ($transaction as $transaksi)
                        <div class="text-group mt-3">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex justify-content-start">
                                    <span class="icon-transaksi" style="background-color: #f5f4f8;
                                                    border-radius: 10px;
                                                    color: #717a90;
                                                    font-size: 15px;
                                                    text-align: center;
                                                    line-height: 30px;
                                                    padding: 5px;
                                                    width: 40px;
                                                    min-width: 40px;
                                                    height: 40px;">
                                        <i class="fa fa-shopping-bag fa-xs"></i>
                                    </span> &nbsp;&nbsp;
                                    <div class="ml-2">
                                        <p class="kode_transaksi font-weight-semibold" style="margin: 0;
                                                        color: #636a7b;">{{ $transaksi->nomor_nota }}
                                        </p>
                                        <p class="des-transaksi" style="margin: 0;
                                                        color: #a9aebc;
                                                        font-size: 12px;">Rp
                                            {{ number_format($transaksi->relasi_tempPenjualan->sum('sub_total'), 0, '', '.') }}
                                        </p>
                                    </div>
                                </div>
                                <span class="w-transaksi"
                                    style="	margin: 0;
                                                    color: #a9aebc;
                                                    font-size: 10px;">{{ Carbon\Carbon::parse($transaksi->created_at)->diffForHumans() }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-auto p-2">
                    {{ $transaction->links() }}
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    @if (count($incomes) != 0)
                        @foreach ($incomes as $income)
                            "{{ date('d M, Y', strtotime($income)) }}",
                        @endforeach
                    @endif
                ],
                datasets: [{
                    label: '',
                    data: [
                        @if (count($incomes) != 0)
                            @foreach ($incomes as $income)
                                @php
                                    $total = \App\Models\tempPenjualan::whereDate('created_at', $income)->sum('sub_total');
                                @endphp
                                "{{ $total }}",
                            @endforeach
                        @endif
                    ],
                    backgroundColor: 'RGB(44, 77, 240)',
                    borderColor: 'RGB(44, 77, 240)',
                    borderWidth: 0
                }]
            },
            options: {
                title: {
                    display: false,
                    text: ''
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                if (parseInt(value) >= 1000) {
                                    return 'Rp. ' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g,
                                        ",");
                                } else {
                                    return 'Rp. ' + value;
                                }
                            }
                        }
                    }],
                    xAxes: [{
                        barPercentage: 0.2
                    }]
                },
                legend: {
                    display: false
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.yLabel;
                        }
                    }
                }
            }
        });

/*         $(document).on('click', '.chart-filter', function(e) {
            e.preventDefault();
            var data_filter = $(this).attr('data-filter');
            if (data_filter == 'pemasukan') {
                $('.btn-filter-chart').html('Pemasukan');
                $('.chart-title').html('Pemasukan 1 Minggu Terakhir');
            } else if (data_filter == 'pelanggan') {
                $('.btn-filter-chart').html('Pelanggan');
                $('.chart-title').html('Pelanggan 1 Minggu Terakhir');
            }
            $.ajax({
                url: "{{ url('/dashboard/chart') }}/" + data_filter,
                method: "GET",
                success: function(response) {
                    if (data_filter == 'pemasukan') {
                        if (response.incomes.length != 0) {
                            changeDataPemasukan(myChart, response.incomes, response.total);
                        }
                    } else if (data_filter == 'pelanggan') {
                        if (response.customers.length != 0) {
                            changeDataPelanggan(myChart, response.customers, response.jumlah);
                        }
                    }
                }
            });
        }); */
    </script>
@endsection
