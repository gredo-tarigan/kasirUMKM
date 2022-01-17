     <!-- script CRUD Modal -->
     <script>
         $(document).ready(function() {

             toastr.options.preventDuplicates = true;

             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });

             var formatter = new Intl.NumberFormat('id-ID', {
                 style: 'currency',
                 currency: 'IDR',
                 minimumFractionDigits: 0

             });

             //GET ALL COUNTRIES
             var table = $('#tabelPenjualan').DataTable({
                 processing: true,
                 info: true,
                 ajax: "{{ route('get.penjualan.list') }}",
                 "pageLength": 5,
                 "aLengthMenu": [
                     [5, 10, 25, 50, -1],
                     [5, 10, 25, 50, "All"]
                 ],

                 aoColumns: [
                     /* {
                                              data: 'id',
                                              name: 'id'
                                          }, */
                     // {data:'checkbox', name:'checkbox', orderable:false, searchable:false},
                     {
                         data: 'DT_RowIndex',
                         name: 'DT_RowIndex'
                     },
                     {
                         data: 'nomor_nota',
                         name: 'nomor_nota'
                     },
                     {
                         data: 'nama',
                         name: 'nama'
                     },
                     {
                         mData: 'detail',
                         name: 'detail'
                     },
                     {
                         mData: format_totalNota,
                         name: 'total'
                     },
                     /* {
                         data: 'actions',
                         name: 'actions',
                         orderable: false,
                         searchable: false
                     }, */
                 ]

             });

             function format_totalNota(data) {
                 return formatter.format(data.total);
             }

             function detailNota(data, type, dataToSet) {
                 //return data.massa_pieces + "" + data.kategori_penjualan_id;
                 return data.detail2 + " <br> " + data.detail1; //dari kontroller
             }


             /* table.column(5).visible(0);
             $(".update_data input").on("change", function(e) {
                 const kaloCheck = e.currentTarget.checked;
                 if (kaloCheck) {
                     table.column(5).visible(1);
                 } else {
                     table.column(5).visible(0);
                 }
             }); */

             // Detail Nota //
             $(document).on('click', '#detailBtnPenjualan', function(e) {
                 e.preventDefault();
                 var id_nota_penjualan = $(this).val();
                 $.ajax({
                     type: "GET",
                     url: "/get-detailPenjualanNota/" + id_nota_penjualan,
                     success: function(response) {
                         console.log(response);
                         $('#detailNotaNomorNota').val(response.detailPenjualan.nomor_nota);
                         $('#detailNotaNamaPembeli').val(response.detailPenjualan.nama);
                     }
                 });
                 var tableDetailPenjualan = $('#tabelDetailPenjualan').DataTable({
                     processing: true,
                     info: true,
                     ajax: {
                         url: "/get-detailPenjualan/" + id_nota_penjualan
                     },
                     "pageLength": 5,
                     "searching": false,
                     "lengthChange": false,
                     aoColumns: [
                         /* {
                                                  data: 'id',
                                                  name: 'id'
                                              }, */
                         // {data:'checkbox', name:'checkbox', orderable:false, searchable:false},
                         {
                             data: 'DT_RowIndex',
                             name: 'DT_RowIndex'
                         },
                         {
                             data: 'barang_id',
                             name: 'barang_id',
                         },
                         {
                             mData: getMassaPiecesdanKategoriPenjualan,
                             name: 'massa_pieces',
                         },
                         {
                             mData: format_hargaDetailNota,
                             name: 'harga_jadi',
                         },
                         {
                             mData: format_subtotalDetailNota,
                             name: 'sub_total',
                         },
                     ],

                 });
             });

             $('#modalTabel').on('hidden.bs.modal', function() {
                 $('#tabelDetailPenjualan').dataTable().fnDestroy();
             });

             // Fitur keren Datatable menampilkan 2 kolom database dalam 1 kolom tabel
             function getMassaPiecesdanKategoriPenjualan(data, type, dataToSet) {
                 //return data.massa_pieces + "" + data.kategori_penjualan_id;
                 return data.massa_pieces + " " + data.penjualan; //dari kontroller
             }

             function format_hargaDetailNota(data) {
                 return formatter.format(data.harga_jadi);
             }

             function format_subtotalDetailNota(data) {
                 return formatter.format(data.sub_total);
             }
             //

             // ======== //
             /*                 $(document).on('click', '#detailBtnPenjualan', function(e) {
                                     e.preventDefault();
                                     var id_nota_penjualan = $(this).val();
                                     //console.log(id_nota_penjualan);
                                     $.ajax({
                                             type: "GET",
                                             url: "/get-detailPenjualan/" + id_nota_penjualan,
                                             success: function(response) {

                                                 if (response.status == 404) {
                                                     $('modalNotif').modal('show');
                                                     $('#success_message').html("");
                                                     $('#success_message').addClass('alert alert-danger');
                                                     $('#success_message').text(response.message);
                                                 } else {
                                                     console.log(response);
                                                     var tableDetailPenjualan = $('#tabelDetailPenjualan').DataTable({
                                                         processing: true,
                                                         info: true,
                                                         ajax: {
                                                             url: "/get-detailPenjualan/" + id_nota_penjualan
                                                         },
                                                         "pageLength": 5,
                                                         "searching": false,
                                                         "lengthChange": false,
                                                         columns: [
                                                             {
                                                                 data: 'DT_RowIndex',
                                                                 name: 'DT_RowIndex'
                                                             },
                                                             {
                                                                 data: 'barang_id',
                                                                 name: 'barang_id',
                                                             },
                                                             {
                                                                 data: 'massa_pieces',
                                                                 name: 'massa_pieces',
                                                             },
                                                             {
                                                                 data: 'harga_jadi',
                                                                 name: 'harga_jadi',
                                                             },
                                                             {
                                                                 data: 'sub_total',
                                                                 name: 'sub_total',
                                                             },
                                                         ],

                                                     });

                                                 }
                                             });

                                     }); */


             /* $(document).on('click', '#update_akunBtn', function(e) {
                 e.preventDefault();

                 $(this).text("Updating");

                 var id_akun = $('#edit_DAkun_id').val();
                 var data = {
                     'nama_akun': $('#edit_namaAkun').val(),
                     'username': $('#edit_username').val(),
                     'password': $('#edit_password').val(),
                     'noHp_akun': $('#edit_noHpAkun').val(),
                     'tipe_akun': $('#edit_tipeAkun').val(),
                     'alamat_akun': $('#edit_alamatAkun').val(),
                 }
                 //console.log(data);


                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });

                 $.ajax({
                     type: "PUT",
                     url: "/update-dataAkun/" + id_akun,
                     data: data,
                     dataType: "json",
                     success: function(response) {
                         //console.log(response);
                         if (response.status == 400) {
                             $('#updateform_errList').html("");
                             $('#updateform_errList').addClass('alert alert-danger');
                             $.each(response.errors, function(key, err_values) {
                                 $('#updateform_errList').append('<li>' + err_values +
                                     '</li>');
                             });
                             $('#update_akunBtn').text("Update Data");

                         } else if (response.status == 404) {
                             $('#updateform_errList').html("");
                             $('#success_message').addClass('alert alert-success');
                             $('#success_message').text(response.message);
                             $('#update_akunBtn').text("Update Data");

                         } else {
                             $('#updateform_errList').html("");
                             $('#success_message').html("");
                             $('#success_message').addClass('alert alert-success');
                             $('#success_message').text(response.message);

                             $('#modalEdit').modal('hide');
                             $('#modalNotif').modal('show');
                             $('#update_akunBtn').text("Update Data");
                             //fetchDataBarang();
                             $('#tabelAkun').DataTable().ajax.reload(null, false);
                         }
                     }

                 })


             });

             $(document).on('click', '#hapusBtnAkun', function(e) {
                 e.preventDefault();
                 var id_akunDelete = $(this).val();
                 //alert(id_akunDelete);
                 $('#delete_DAkun_id').val(id_akunDelete);

             });

             $(document).on('click', '#delete_data_akun', function(e) {
                 e.preventDefault();

                 $(this).text("Deleting");
                 var id_akunDelete = $('#delete_DAkun_id').val();
                 //console.log(id_akunDelete);

                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });

                 $.ajax({
                     type: "DELETE",
                     url: "/delete-dataAkun/" + id_akunDelete,
                     success: function(response) {
                         //console.log(response);
                         $('#success_message').addClass('alert alert-success');
                         $('#success_message').text(response.message);
                         $('#modalHapus').modal('hide');
                         $('#modalNotif').modal('show');
                         $('#delete_data_akun').text("Delete Data");
                         //fetchDataBarang(); 
                         $('#tabelAkun').DataTable().ajax.reload(null, false);

                     }

                 })
             }); */

             var table = $('#tabelLaporanPenjualan').DataTable({
                 processing: true,
                 info: true,
                 searching: false,
                 ajax: "{{ route('get.laporanPenjualan.list') }}",
                 buttons: [{
                         text: 'csv',
                         extend: 'csvHtml5',
                         exportOptions: {
                             columns: ':visible:not(.not-export-col)'
                         }
                     },
                     {
                         text: 'excel',
                         extend: 'excelHtml5',
                         exportOptions: {
                             columns: ':visible:not(.not-export-col)'
                         }
                     },
                     {
                         text: 'pdf',
                         extend: 'pdfHtml5',
                         exportOptions: {
                             columns: ':visible:not(.not-export-col)'
                         }
                     },
                     {
                         text: 'print',
                         extend: 'print',
                         exportOptions: {
                             columns: ':visible:not(.not-export-col)'
                         }
                     },
                 ],
                 "pageLength": 5,
                 "aLengthMenu": [
                     [5, 10, 25, 50, -1],
                     [5, 10, 25, 50, "All"]
                 ],

                 aoColumns: [
                     {
                         data: 'DT_RowIndex',
                         name: 'DT_RowIndex'
                     },
                     {
                         data: 'created_at_LP',
                         name: 'created_at_LP'
                     },
                     {
                         mData: format_totalLaporanPenjualan,
                         name: 'total_LP'
                     }
                 ]

             });

             function format_totalLaporanPenjualan(data) {
                 return formatter.format(data.total_LP);
             }

             $('#csvLaporan').click(function() {
                 let tabelPengeluaranLaporan = $('#tabelLaporanPenjualan').DataTable();
                 tabelPengeluaranLaporan.button('.buttons-csv').trigger();
             });
             $('#excelLaporan').click(function() {
                 let tabelPengeluaranLaporan = $('#tabelLaporanPenjualan').DataTable();
                 tabelPengeluaranLaporan.button('.buttons-excel').trigger();
             });
             $('#pdfLaporan').click(function() {
                 let tabelPengeluaranLaporan = $('#tabelLaporanPenjualan').DataTable();
                 tabelPengeluaranLaporan.button('.buttons-pdf').trigger();
             });
             $('#printLaporan').click(function() {
                 let tabelPengeluaranLaporan = $('#tabelLaporanPenjualan').DataTable();
                 tabelPengeluaranLaporan.button('.buttons-print').trigger();
             });

         });
     </script>
     <!-- END -->
