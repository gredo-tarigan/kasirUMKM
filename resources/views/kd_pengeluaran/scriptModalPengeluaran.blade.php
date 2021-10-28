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
             var table = $('#tabelPengeluaran').DataTable({
                 processing: true,
                 info: true,
                 ajax: "{{ route('get.pengeluaran.list') }}",
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
                         data: 'nama_pengeluaran',
                         name: 'nama_pengeluaran'
                     },
                     {
                         mData: format_nominal,
                         name: 'nominal'
                     },

                     {
                         data: 'kategori_pengeluaran_id',
                         name: 'kategori_pengeluaran_id'
                     },
                     {
                         data: 'keterangan',
                         name: 'keterangan'
                     },
                     {
                         data: 'created_at',
                         name: 'created_at',
                     },
                     {
                         data: 'actions',
                         name: 'actions',
                         orderable: false,
                         searchable: false
                     },
                 ]

             });

             function format_nominal(data) {
                 return formatter.format(data.nominal);
             }

             table.column(6).visible(0);
             table.column(4).visible(0);
             $(".update_data input").on("change", function(e) {
                 const kaloCheck = e.currentTarget.checked;
                 if (kaloCheck) {
                     table.column(6).visible(1);
                     table.column(4).visible(1);
                 } else {
                     table.column(6).visible(0);
                     table.column(4).visible(0);
                 }
             });


             // ======== //

             $(document).on('click', '#hapusBtnPengeluaran', function(e) {
                 e.preventDefault();
                 var id_pengeluaranDelete = $(this).val();
                 //alert(id_pengeluaranDelete);
                 $('#delete_DPeng_id').val(id_pengeluaranDelete);

             });

             $(document).on('click', '#delete_data_pengeluaran', function(e) {
                 e.preventDefault();

                 $(this).text("Deleting");
                 var id_pengeluaranDelete = $('#delete_DPeng_id').val();

                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });

                 $.ajax({
                     type: "DELETE",
                     url: "/delete-dataPengeluaran/" + id_pengeluaranDelete,
                     success: function(response) {
                         //console.log(response);
                         $('#success_message').addClass('alert alert-success');
                         $('#success_message').text(response.message);
                         $('#modalHapus').modal('hide');
                         $('#modalNotif').modal('show');
                         $('#delete_data_pengeluaran').text("Delete Data");
                         //fetchDataBarang(); 
                         $('#tabelPengeluaran').DataTable().ajax.reload(null, false);
                         $('#tabelPengeluaranLaporan').DataTable().ajax.reload(null, false);

                     }

                 })
             });

             $(document).on('click', '#editBtnPengeluaran', function(e) {
                 e.preventDefault();
                 var id_pengeluaran = $(this).val();
                 //console.log(id_pengeluaran);
                 $.ajax({
                     type: "GET",
                     url: "/edit-dataPengeluaran/" + id_pengeluaran,
                     success: function(response) {
                         //console.log(response);
                         if (response.status == 404) {
                             $('modalNotif').modal('show');
                             $('#success_message').html("");
                             $('#success_message').addClass('alert alert-danger');
                             $('#success_message').text(response.message);
                         } else {
                             $('#edit_np').val(response.editDataPengeluaran.nama_pengeluaran);
                             $('#edit_nomp').val(response.editDataPengeluaran
                                 .nominal);
                             $('#edit_kp').val(response.editDataPengeluaran.keterangan);
                             $('#edit_katp').val(response.editDataPengeluaran
                                 .kategori_pengeluaran_id);
                             $('#edit_DPeng_id').val(id_pengeluaran);
                         }
                     }
                 })
             });

             $(document).on('click', '#update_pengeluaranBtn', function(e) {
                 e.preventDefault();

                 $(this).text("Updating");

                 var id_pengeluaran = $('#edit_DPeng_id').val();
                 var data = {
                     'nama_pengeluaran': $('#edit_np').val(),
                     'nominal_pengeluaran': $('#edit_nomp').val(),
                     'ket_pengeluaran': $('#edit_kp').val(),
                     'kategori_pengeluaran': $('#edit_katp').val(),
                 }
                 //console.log(id_pengeluaran);


                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });

                 $.ajax({
                     type: "PUT",
                     url: "/update-dataPengeluaran/" + id_pengeluaran,
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
                             $('#update_pengeluaranBtn').text("Update Data");

                         } else if (response.status == 404) {
                             $('#updateform_errList').html("");
                             $('#success_message').addClass('alert alert-success');
                             $('#success_message').text(response.message);
                             $('#update_pengeluaranBtn').text("Update Data");

                         } else {
                             $('#updateform_errList').html("");
                             $('#success_message').html("");
                             $('#success_message').addClass('alert alert-success');
                             $('#success_message').text(response.message);

                             $('#modalEdit').modal('hide');
                             $('#modalNotif').modal('show');
                             $('#update_pengeluaranBtn').text("Update Data");
                             //fetchDataBarang();
                             $('#tabelPengeluaran').DataTable().ajax.reload(null, false);
                             $('#tabelPengeluaranLaporan').DataTable().ajax.reload(null, false);
                         }
                     }

                 })


             });

             $(document).on('click', '#add_data_pengeluaran', function(e) {
                 e.preventDefault();
                 var tambahDataPengeluaran = {
                     'add_np': $('#add_np').val(),
                     'add_nomp': $('#add_nomp').val(),
                     'add_kp': $('#add_kp').val(),
                     'add_katp': $('#add_katp').val(),
                 }
                 //console.log(tambahDataPengeluaran);
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });

                 $.ajax({
                     type: "POST",
                     url: "/expenses",
                     data: tambahDataPengeluaran,
                     dataType: "json",
                     success: function(response) {
                         console.log(response.errors);
                         if (response.status == 400) {
                             $('#saveform_errList').html("");
                             $('#saveform_errList').addClass('alert alert-danger');
                             $.each(response.errors, function(key, err_values) {
                                 $('#saveform_errList').append('<li>' +
                                     err_values +
                                     '</li>');
                             })
                         } else {
                             /* $('#success_message').html("");
                             $('#success_message').addClass('alert alert-success');
                             $('#success_message').text(response.message);
                             $('#modalTambah').modal('hide');
                             $('#modalNotif').modal('show');
                             $('#modalTambah').find('input').val("");
                             //fetchDataBarang();
                             $('#tabelBarang').DataTable().ajax.reload(null, false); */
                             $('#modalTambah').modal('hide');
                             $('#modalTambah').find('input').val("");
                             //fetchDataBarang();
                             $('#tabelPengeluaran').DataTable().ajax.reload(null, false);
                             $('#tabelPengeluaranLaporan').DataTable().ajax.reload(null, false);
                             toastr.success(response.msg);
                         }

                     }
                 });

             });

             var tableLaporan = $('#tabelPengeluaranLaporan').DataTable({
                 processing: true,
                 info: true,
                 ajax: "{{ route('get.pengeluaran.laporan') }}",
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
                         data: 'created_at',
                         name: 'created_at',
                     },
                     {
                         data: 'kategoriPengeluaran',
                         name: 'kategoriPengeluaran'
                     },
                     {
                         mData: format_nominal,
                         name: 'nominal'
                     },
                 ]

             });

             $("ul ul a").click(function() {
                 let i = $(this).index() + 1
                 let table = $('#tabelPengeluaran').DataTable();
                 if (i == 1) {
                     table.button('.buttons-csv').trigger();
                 } else if (i == 2) {
                     table.button('.buttons-excel').trigger();
                 } else if (i == 3) {
                     table.button('.buttons-pdf').trigger();
                 } else if ($('#bl_print').click()) {
                     table.button('.buttons-print').trigger();
                 }
             });

             $('#csvLaporan').click(function() {
                 let tabelPengeluaranLaporan = $('#tabelPengeluaranLaporan').DataTable();
                 tabelPengeluaranLaporan.button('.buttons-csv').trigger();
             });
             $('#excelLaporan').click(function() {
                 let tabelPengeluaranLaporan = $('#tabelPengeluaranLaporan').DataTable();
                 tabelPengeluaranLaporan.button('.buttons-excel').trigger();
             });
             $('#pdfLaporan').click(function() {
                 let tabelPengeluaranLaporan = $('#tabelPengeluaranLaporan').DataTable();
                 tabelPengeluaranLaporan.button('.buttons-pdf').trigger();
             });
             $('#printLaporan').click(function() {
                 let tabelPengeluaranLaporan = $('#tabelPengeluaranLaporan').DataTable();
                 tabelPengeluaranLaporan.button('.buttons-print').trigger();
             });

             //$(document).on('show','#modalTabel', function(e) {
             var tableJenisLaporan = $('#tabelJenisPengeluaran').DataTable({
                 processing: true,
                 info: true,
                 ajax: "{{ route('get.jenisPengeluaran.tabel') }}",
                 "pageLength": 5,
                 "searching": false,
                 "lengthChange": false,
                 columns: [
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
                         data: 'kategori',
                         name: 'kategori',
                     },
                     {
                         data: 'actions',
                         name: 'actions',
                         orderable: false,
                         searchable: false
                     },
                 ],

             });
             // });

             // Jenis Pengeluaran =======
             $(document).on('click', '#hapusBtnJenisPengeluaran', function(e) {
                 e.preventDefault();
                 var id_jenisPengeluaranDelete = $(this).val();
                 //alert(id_jenisPengeluaranDelete);               
                 $('#delete_DJenisPeng_id').val(id_jenisPengeluaranDelete);
                 $('#modalTabel').modal('hide');
             });
             // Kalo close biar modalTabel muncul lagi
             $(document).on('click', '#closeBtnJenisPengeluaran', function(e) {
                 e.preventDefault();
                 $('#modalTabel').modal('show');
             });

             $(document).on('click', '#delete_jenis_pengeluaran', function(e) {
                 e.preventDefault();

                 $(this).text("Deleting");
                 var id_jenisPengeluaranDelete = $('#delete_DJenisPeng_id').val();

                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });

                 $.ajax({
                     type: "DELETE",
                     url: "/delete-jenisPengeluaran/" + id_jenisPengeluaranDelete,
                     success: function(response) {
                         //console.log(response);
                         $('#success_message').addClass('alert alert-success');
                         $('#success_message').text(response.message);
                         $('#modalHapus2').modal('hide');
                         $('#modalTabel').modal('show');
                         $('#delete_jenis_pengeluaran').text("Delete Data");
                         $('#tabelJenisPengeluaran').DataTable().ajax.reload(null, false);
                     }

                 })
             });

             $(document).on('click', '#editBtnJenisPengeluaran', function(e) {
                 e.preventDefault();
                 var id_jenisPengeluaranEdit = $(this).val();
                 $('#modalTabel').modal('hide');
                 //console.log(id_jenisPengeluaranEdit);
                 $.ajax({
                     type: "GET",
                     url: "/edit-jenisPengeluaran/" + id_jenisPengeluaranEdit,
                     success: function(response) {
                         //console.log(response);
                         if (response.status == 404) {
                             $('modalNotif').modal('show');
                             $('#success_message').html("");
                             $('#success_message').addClass('alert alert-danger');
                             $('#success_message').text(response.message);
                         } else {
                             $('#edit_jenisPengeluaran').val(response.editJenisPengeluaran.kategori_pengeluaran);
                             $('#edit_DJenisPeng_id').val(id_jenisPengeluaranEdit);
                         }
                     }
                 })
             });

             // Kalo close biar modalTabel muncul lagi
             $('#modalEdit2').on('hidden.bs.modal', function() {
                 $('#modalTabel').modal('show');
             });
             // Setiap model tabel close tabel lainnya di refresh
             $('#modalTabel').on('hidden.bs.modal', function() {
                 $('#tabelPengeluaran').DataTable().ajax.reload(null, false);
                 $('#tabelPengeluaranLaporan').DataTable().ajax.reload(null, false);
                 //menghilangkan pesan validator ketika modelTabel di close
                 $('#saveform_errListJenisPengeluaran').html("");
                 $('#saveform_errListJenisPengeluaran').removeClass();
                 //menghilangkan isi kolom input ketika modelTabel di close
                 $('#add_jenisPengeluaran').val("");
                 
             });

             $(document).on('click', '#update_jenisPengeluaranBtn', function(e) {
                 e.preventDefault();
                 $(this).text("Updating");
                 var id_jenisPengeluaran = $('#edit_DJenisPeng_id').val();
                 var data = {
                     'jenis_pengeluaran': $('#edit_jenisPengeluaran').val(),
                 }
                 console.log(id_jenisPengeluaran);
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });
                 $.ajax({
                     type: "PUT",
                     url: "/update-jenisPengeluaran/" + id_jenisPengeluaran,
                     data: data,
                     dataType: "json",
                     success: function(response) {
                         //console.log(response);
                         if (response.status == 400) {
                             $('#updateform_errList2').html("");
                             $('#updateform_errList2').addClass('alert alert-danger');
                             $.each(response.errors, function(key, err_values) {
                                 $('#updateform_errList2').append('<li>' + err_values +
                                     '</li>');
                             });
                             $('#update_jenisPengeluaranBtn').text("Update Data");

                         } else if (response.status == 404) {
                             $('#updateform_errList2').html("");
                             $('#success_message').addClass('alert alert-success');
                             $('#success_message').text(response.message);
                             $('#update_jenisPengeluaranBtn').text("Update Data");

                         } else {
                             $('#updateform_errList2').html("");
                             $('#success_message').html("");
                             $('#success_message').addClass('alert alert-success');
                             $('#success_message').text(response.message);

                             $('#modalEdit2').modal('hide');
                             //$('#modalTabel').modal('show');
                             $('#update_jenisPengeluaranBtn').text("Update Data");
                             $('#tabelJenisPengeluaran').DataTable().ajax.reload(null, false);
                         }
                     }

                 })
             });

             $(document).on('click', '#add_data_jenisPengeluaran', function(e) {
                 e.preventDefault();
                 var tambahJenisPengeluaran = {
                     'add_jenis_pengeluaran': $('#add_jenisPengeluaran').val(),
                 }
                 console.log(tambahJenisPengeluaran);
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });
                 $.ajax({
                     type: "POST",
                     url: "/expensesJenisPengeluaran",
                     data: tambahJenisPengeluaran,
                     dataType: "json",
                     success: function(response) {
                         console.log(response.errors);
                         if (response.status == 400) {
                             $('#saveform_errListJenisPengeluaran').html("");
                             $('#saveform_errListJenisPengeluaran').addClass('alert alert-danger');
                             $.each(response.errors, function(key, err_values) {
                                 $('#saveform_errListJenisPengeluaran').append('<li>' +
                                     err_values +
                                     '</li>');
                             })
                         } else {
                             $('#modalTambah').modal('hide');
                             $('#modalTambah').find('input').val("");
                             $('#tabelJenisPengeluaran').DataTable().ajax.reload(null, false);
                             toastr.success(response.msg);
                         }

                     }
                 });

             });

             // =========================

         });
     </script>
     <!-- END -->
