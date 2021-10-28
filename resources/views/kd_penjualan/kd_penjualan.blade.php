@extends('layouts.main')
@extends('kd_penjualan.modalPenjualan')
@extends('layouts.modalAkunUser')
@section('content')
    <!-- Untuk mendukung AJAX; Fitur Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">
    <!-- END -->
    <div class="col-lg-7">
        <div class=" card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold">Data Penjualan</p>
            </div>
            <div class="card-body">
                <div class="table-responsive table-full table mt-2 mb-3 table-striped" id="dataTable" role="grid"
                    aria-describedby="dataTable_info">
                    <table class="table table-bordered" id="tabelPenjualan">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Nomor Nota</th>
                                <th>Nama Pembeli</th>
                                <th>Detail Penjualan</th>
                                <th>Total</th>
                                {{-- <th><i class="fa fa-pencil-square-o fa-sm"></i>
                                / <i class="fa fa-trash-o fa-sm">
                            </th> --}}
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <td>#</td>
                                <td>Nomor Nota</td>
                                <td>Nama Pembeli</td>
                                <td>Detail Penjualan</td>
                                <td>Total</td>
                                {{-- <td><i class="fa fa-pencil-square-o fa-sm"></i>
                                / <i class="fa fa-trash-o fa-sm">
                            </td> --}}
                            </tr>
                        </tfoot>
                    </table>
                </div>
                {{-- <div class="row mb-2">
                <div class="col-md-6 text-nowrap">
                    <div class="form-check form-switch toggle-text update_data">
                        <input class="form-check-input" type="checkbox" id="Mode_Kustom">
                        <div><i class="fa fa-pencil-square-o fa-sm"></i> / <i class="fa fa-trash-o fa-sm"></i>
                        </div>
                    </div>
                </div>
            </div> --}}
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card shadow">
            <div class="card-header py-3">
                <p class="text-primary m-0 fw-bold">Laporan Penjualan</p>
            </div>
            <div class="card-body">
                <div class="table-responsive table-full table mt-2 mb-3 table-striped" id="dataTable" role="grid"
                    aria-describedby="dataTable_info">
                    <table class="table table-bordered" id="tabelLaporanPenjualan">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Bulan</th>
                                <th>Total Penjualan / Bulan</th>                          
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <td>#</td>
                                <td>Bulan</td>
                                <td>Total Penjualan / Bulan</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="row mb-2">
                    <div class="text-md-end">
                        <div class="btn-group laporanPenjualan">
                            <button type="button" class="btn btn-success btn-sm dropdown-toggle text-white"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                    class="fa fa-download fa-sm text-white-50"></i>&nbsp;
                                Generate Laporan
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" id="csvLaporan">Export CSV</a>
                                <a class="dropdown-item" href="#" id="excelLaporan">Export Excel</a>
                                <a class="dropdown-item" href="#" id="pdfLaporan">Export PDF</a>
                                <div class="dropdown-divider"></div>
                                <a id="bl_print" class="dropdown-item" href="#" id="printLaporan">Print</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        // Load the Visualization API and the corechart package.
        google.charts.load('current', {
            'packages': ['corechart']
        });

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawMonthlyChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawMonthlyChart(chart_data, chart_main_title) {
            let jsonData = chart_data;
            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'month');
            data.addColumn('number', 'profit');
            $.each(jsonData, (i, jsonData) => {
                let month = jsonData.month;
                let profit = parseFloat($.trim(jsonData.profit));
                data.addRows([
                [month, profit]
                ]);
            });



            // Set chart options
            var options = {
                title: 'Grafik Penjualan Bulanan',

                hAxis: {
                    title: "Bulan"
                },
                vAxis: {
                    title: "Total Penjualan"
                },
                chartArea: {
                    width: '50%',
                    height: '80%'
                }

            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);

         
        }

        function load_monthly_data(year, title) {
                const temp_title = title + ' ' + year;
                $.ajax({
                    url: 'dashboard/fetch_data',
                    method: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        year:year
                    },
                    dataType: "JSON",
                    success: function(data) {
                        drawMonthlyChart(data, temp_title);
                    }

                 
                });
                console.log(`Year: ${year}`);
            }
    </script>
    <script>
        $(document).ready(function() {
            $('#year').change(function() {
                var year = $(this).val();
                if (year != '') {
                    //alert(year);
                    load_monthly_data(year, 'Monthly Data for:');
                    console.log(`Year: ${year}`);
                }
            });
        });
    </script> --}}

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

@endsection
