     <!-- script CRUD Modal -->
     <script>
         $(document).ready(function() {


             //fetchDataBarang();

             /* function fetchDataBarang() {
                 $.ajax({
                     type: "GET",
                     url: "/fetch-dataBarang",
                     dataType: "json",
                     success: function(response) {
                         //console.log(response.fetchDataBarang);
                         $('tbody').html("");
                         $.each(response.fetchDataBarang, function(key, item) {
                             $('tbody').append('<tr class="text-center">\
                                                                                               <td>' + item.id +
                                 '</td>\
                                                                                               <td style="white-space: nowrap;">' +
                                 item
                                 .nama_barang + '</td>\
                                                                                               <td>' + item
                                 .hargamasuk_barang + '</td>\
                                                                                               <td>' + item
                                 .hargajual_barang + '</td>\
                                                                                               <td>' + item.stok_barang +
                                 '</td>\
                                                                                               <td class="update" style="display:none;">' +
                                 item
                                 .supplier_barang +
                                 '</td>\
                                                                                               <td class="update" style="display:none;">' +
                                 item
                                 .ket_barang +
                                 '</td>\
                                                                                               <td class="update" style="display:none;">' +
                                 item
                                 .updated_at +
                                 '</td>\
                                                                                               <td style="white-space: nowrap; display:none;"  class="text-center update">\
                                                                                                <button id="editBtnBarang" type="button" class="btn btn-primary btn-sm d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalEdit" value=" ' +
                                 item.id +
                                 ' "><i class="fa fa-pencil-square-o fa-sm text-white-50"></i>&nbsp;Edit</button>\
                                                                                                <button id="hapusBtnBarang" class="btn btn-danger btn-sm d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modalHapus" value=" ' +
                                 item.id +
                                 ' "><i class="fa fa-trash-o fa-sm text-white-50"></i>&nbsp;Hapus</button>\
                                                                                               </td>\
                                                                                           \</tr>');
                         });
                         if ($(".update_data input").prop("checked")) {
                             $(".update").show();
                         }
                         //tabel akan tergenerate ketika ada data baru. Disini dipastikan untuk menampilkan class=update kalau toggle nya tetep nyala

                         //$(".update").show();
                     }
                 });
             } */

             toastr.options.preventDuplicates = true;

             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });


             //GET ALL COUNTRIES
             var table = $('#tabelBarang').DataTable({
                 processing: true,
                 info: true,
                 ajax: "{{ route('get.countries.list') }}",
                 // dom: "Blfrtip",
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
                         data: 'nama',
                         name: 'nama'
                     },
                     {
                         data: 'harga_masuk',
                         name: 'harga_masuk'
                     },
                     {
                         data: 'harga_jual',
                         name: 'harga_jual'
                     },
                     {
                         mData: getStokdanKategoriPenjualan,
                         name: 'getStokdanKategoriPenjualan'
                     },
                     {
                         data: 'supplier',
                         name: 'supplier'
                     },
                     {
                         data: 'actions',
                         name: 'actions',
                         orderable: false,
                         searchable: false
                     },
                 ]

             });

             table.column(5).visible(0);
             table.column(6).visible(0);
             $(".update_data input").on("change", function(e) {
                 const kaloCheck = e.currentTarget.checked;
                 if (kaloCheck) {
                     table.column(5).visible(1);
                     table.column(6).visible(1);
                 } else {
                     table.column(5).visible(0);
                     table.column(6).visible(0);
                 }
             });

             // ======== //
             function getStokdanKategoriPenjualan(data, type, dataToSet) {
                 //return data.massa_pieces + "" + data.kategori_penjualan_id;
                 return data.stok + " " + data.penjualan; //dari kontroller
             }
             // ======== //

             // ======== //

             $("ul ul .print").click(function() {
                 var i = $(this).index() + 1
                 var table = $('#tabelBarang').DataTable();
                 if (i == 1) {
                     table.button('.buttons-csv').trigger();
                 } else if (i == 2) {
                     table.button('.buttons-excel').trigger();
                 } else if (i == 3) {
                     table.button('.buttons-pdf').trigger();
                 }
             });

             // DataTable Stock Opname
             /* var tabelStockOpname = $('#tabelStockOpname').DataTable({
                 processing: true,
                 info: true,
                 ajax: "{{ route('get.tabelstockopname.list') }}",
                 // dom: "Blfrtip",
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
                 aoColumns: [{
                         data: 'DT_RowIndex',
                         name: 'DT_RowIndex'
                     },
                     {
                         data: 'nama_barang',
                         name: 'nama_barang'
                     },
                     {
                         data: 'kategori_barang',
                         name: 'kategori_barang'
                     },
                     {
                         data: 'stok_awal',
                         name: 'stok_awal'
                     },
                     {
                         data: 'stok_keluar',
                         name: 'stok_keluar'
                     },
                     {
                         data: 'stok_masuk',
                         name: 'stok_masuk'
                     },
                     {
                         data: 'stok_sistem',
                         name: 'stok_sistem'
                     },
                     {
                         data: 'stok_fisik',
                         name: 'stok_fisik'
                     },
                     {
                         mData: getSelisih,
                         name: 'getSelisih'
                     },
                     {
                         data: 'actions',
                         name: 'actions',
                         orderable: false,
                         searchable: false
                     },
                 ]

             });

             // ======== //
             function getSelisih(data, type, dataToSet) {
                 //return data.massa_pieces + "" + data.kategori_penjualan_id;
                 return data.stok_fisik - data.stok_sistem; //dari kontroller
             } */
             // ======== //
             // ======== //

             $(document).on('click', '#hapusBtnBarang', function(e) {
                 e.preventDefault();
                 var id_barangDelete = $(this).val();
                 //alert(id_barangDelete);
                 $('#delete_DB_id').val(id_barangDelete);

             });

             $(document).on('click', '#delete_data_barang', function(e) {
                 e.preventDefault();

                 $(this).text("Deleting");
                 var id_barangDelete = $('#delete_DB_id').val();

                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });

                 $.ajax({
                     type: "DELETE",
                     url: "/delete-dataBarang/" + id_barangDelete,
                     success: function(response) {
                         //console.log(response);
                         $('#success_message').addClass('alert alert-success');
                         $('#success_message').text(response.message);
                         $('#modalHapus').modal('hide');
                         $('#modalNotif').modal('show');
                         $('#delete_data_barang').text("Delete Data");
                         //fetchDataBarang(); 
                         $('#tabelBarang').DataTable().ajax.reload(null, false);

                     }

                 })
             });

             $(document).on('click', '#editBtnBarang', function(e) {
                 e.preventDefault();
                 var id_barang = $(this).val();
                 //console.log(id_barang);
                 $.ajax({
                     type: "GET",
                     url: "/edit-dataBarang/" + id_barang,
                     success: function(response) {
                         //console.log(response);
                         if (response.status == 404) {
                             $('modalNotif').modal('show');
                             $('#success_message').html("");
                             $('#success_message').addClass('alert alert-danger');
                             $('#success_message').text(response.message);
                         } else {
                             $('#edit_nb').val(response.editDataBarang.nama);
                             $('#edit_hmb').val(response.editDataBarang.harga_masuk);
                             $('#edit_hjb').val(response.editDataBarang.harga_jual);
                             $('#edit_stob').val(response.editDataBarang.stok);
                             $('#edit_supb').val(response.editDataBarang.supplier);
                             $('#edit_kb').val(response.editDataBarang.keterangan);
                             $('#edit_kategori_penjualan').val(response.editDataBarang
                                 .kategori_penjualan_id);
                             $('#edit_DB_id').val(id_barang);
                         }
                     }
                 })
             });

             $(document).on('click', '#update_barangBtn', function(e) {
                 e.preventDefault();

                 $(this).text("Updating");

                 var id_barang = $('#edit_DB_id').val();
                 var data = {
                     'nama_barang': $('#edit_nb').val(),
                     'hargamasuk_barang': $('#edit_hmb').val(),
                     'hargajual_barang': $('#edit_hjb').val(),
                     'stok_barang': $('#edit_stob').val(),
                     'supplier_barang': $('#edit_supb').val(),
                     'ket_barang': $('#edit_kb').val(),
                     'kategori_penjualan': $('#edit_kategori_penjualan').val(),
                 }

                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });

                 $.ajax({
                     type: "PUT",
                     url: "/update-dataBarang/" + id_barang,
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
                             $('#update_barangBtn').text("Update Data");

                         } else if (response.status == 404) {
                             $('#updateform_errList').html("");
                             $('#success_message').addClass('alert alert-success');
                             $('#success_message').text(response.message);
                             $('#update_barangBtn').text("Update Data");

                         } else {
                             $('#updateform_errList').html("");
                             $('#success_message').html("");
                             $('#success_message').addClass('alert alert-success');
                             $('#success_message').text(response.message);

                             $('#modalEdit').modal('hide');
                             $('#modalNotif').modal('show');
                             $('#update_barangBtn').text("Update Data");
                             //fetchDataBarang();
                             $('#tabelBarang').DataTable().ajax.reload(null, false);
                         }
                     }

                 })


             });





             $(document).on('click', '#add_data_barang', function(e) {
                 e.preventDefault();
                 var tambahDataBarang = {
                     'add_nb': $('#add_nb').val(),
                     'add_hmb': $('#add_hmb').val(),
                     'add_hjb': $('#add_hjb').val(),
                     'add_stob': $('#add_stob').val(),
                     'add_supb': $('#add_supb').val(),
                     'add_kb': $('#add_kb').val(),
                     //  'kategori_barang': $('#add_kategori_barang').val(),
                     'kategori_penjualan': $('#add_kategori_penjualan').val(),
                 }
                 //console.log(tambahDataBarang);
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });

                 $.ajax({
                     type: "POST",
                     url: "/goods",
                     data: tambahDataBarang,
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
                             $('#tabelBarang').DataTable().ajax.reload(null, false);
                             toastr.success(response.msg);
                         }

                     }
                 });

             });


             // Script Untuk Opname //
             $('#tanggal_dipilih').datepicker({
                 todayBtn: 'linked',
                 format: 'yyyy-mm-dd',
                 autoclose: true
             });

             load_data();

             function load_data(tanggal_dipilih = '') {
                 var tableStockOpname = $('#tabelStockOpname').DataTable({
                     processing: true,
                     serverSide: true,
                     ajax: {
                         url: '{{ route('get.tabelstockopname.list') }}',
                         data: {
                             tanggal_dipilih: tanggal_dipilih
                         }
                     },
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
                     aoColumns: [{
                             data: 'DT_RowIndex',
                             name: 'DT_RowIndex'
                         },
                         {
                             data: 'nama_barang',
                             name: 'nama_barang'
                         },
                         {
                             data: 'kategori_barang',
                             name: 'kategori_barang'
                         },
                         {
                             data: 'stok_awal',
                             name: 'stok_awal'
                         },
                         {
                             mData: getStokKeluar,
                             name: 'getStokKeluar'
                         },
                         {
                             data: 'stok_masuk',
                             name: 'stok_masuk'
                         },
                         {
                             data: 'stok_sistem',
                             name: 'stok_sistem'
                         },
                         {
                             data: 'stok_fisik',
                             name: 'stok_fisik'
                         },
                         {
                             mData: getSelisih,
                             name: 'getSelisih'
                         },
                         {
                             data: 'keterangan',
                             name: 'keterangan'
                         },
                         {
                             data: 'opname_date',
                             name: 'opname_date'
                         },
                         {
                             data: 'updated_at',
                             name: 'updated_at'
                         },
                         {
                             data: 'actions',
                             name: 'actions',
                             orderable: false,
                             searchable: false
                         },
                     ],
                     columnDefs: [{
                             render: function(data, type, full, meta) {
                                 return "<div style='white-space: nowrap;' class='text-center'>" +
                                     data + "</div>";
                             },
                             targets: 1,
                         },
                         {

                             render: function(data, type, full, meta) {
                                 return "<div style='white-space: normal;' class='text-center'>" +
                                     data + "</div>";
                             },
                             targets: 2
                         },
                     ]
                 });

                 tableStockOpname.column(10).visible(0);
                 tableStockOpname.column(11).visible(0);
                 tableStockOpname.column(12).visible(0);
                 ToggleTabelOpname();

                 function ToggleTabelOpname() {
                     $(".Opname input").on("change", function(e) {
                         console.log("cek");
                         const kaloCheck = e.currentTarget.checked;
                         if (kaloCheck) {
                             tableStockOpname.column(10).visible(1);
                             tableStockOpname.column(11).visible(1);
                             tableStockOpname.column(12).visible(1);
                         } else {
                             tableStockOpname.column(10).visible(0);
                             tableStockOpname.column(11).visible(0);
                             tableStockOpname.column(12).visible(0);
                         }
                     });
                 }

                 CheckToggleOpname();

                 function CheckToggleOpname() {
                     if ($(".Opname input").is(':checked')) {
                         tableStockOpname.column(10).visible(1);
                         tableStockOpname.column(11).visible(1);
                         tableStockOpname.column(12).visible(1);
                     } else {
                         tableStockOpname.column(10).visible(0);
                         tableStockOpname.column(11).visible(0);
                         tableStockOpname.column(12).visible(0);
                     }
                 }

                 $("ul ul .printOpname").click(function() {
                     var i = $(this).index() + 1
                     var table = $('#tabelStockOpname').DataTable();
                     if (i == 1) {
                         table.button('.buttons-csv').trigger();
                     } else if (i == 2) {
                         table.button('.buttons-excel').trigger();
                     } else if (i == 3) {
                         table.button('.buttons-pdf').trigger();
                     }
                 });
             }


             function TampilkanStockOpname() {
                 var tanggal_dipilih = $('#tanggal_dipilih').val();
                 if (tanggal_dipilih != '') {
                     $('#tabelStockOpname').DataTable().destroy();
                     load_data(tanggal_dipilih);
                 } else {
                     alert('Silahkan Isi Tanggal Terlebih Dahulu');
                 }
             }

             function TampilkanAtauRefreshStockOpname() {
                 var tanggal_dipilih = $('#tanggal_dipilih').val();
                 if (tanggal_dipilih != '') {
                     $('#tabelStockOpname').DataTable().destroy();
                     load_data(tanggal_dipilih);
                 } else {
                     $('#tabelStockOpname').DataTable().destroy();
                     load_data();
                 }
             }

             $('#TampilkanStockOpname').click(function() {
                 TampilkanStockOpname();
             });


             $('#RefreshStockOpname').click(function() {
                 $('#tanggal_dipilih').val('');
                 $('#buttonOpname').prop('disabled', true);
                 $('#tabelStockOpname').DataTable().destroy();
                 load_data();
             })

             // ======== //
             function getSelisih(data, type, dataToSet) {
                 //return data.massa_pieces + "" + data.kategori_penjualan_id;
                 return bulatin(data.stok_fisik - data.stok_sistem, 2); //dari kontroller
                 //  return data.stok_fisik - data.stok_sistem; //dari kontroller
             }

             function getStokKeluar(data, type, dataToSet) {
                 //return data.massa_pieces + "" + data.kategori_penjualan_id;
                 return bulatin(data.stok_awal - data.stok_sistem, 2); //dari kontroller
                 //  return data.stok_fisik - data.stok_sistem; //dari kontroller
             }

             function bulatin(value, precision) {
                 var multiplier = Math.pow(10, precision || 0);
                 return Math.round(value * multiplier) / multiplier;
             }
             // ======== //
             // ======== //
             // Opname --Finish //

             // == Kode Buat buat untuk kondisi dari option select Opname ==//
             getSelectDataOpname($("#selectBarangOpname"));


             $("#selectBarangOpname").change(function() {
                 getSelectDataOpname($(this));
             });

             function getSelectDataOpname(a) {
                 var $option = a.find("option:selected");
                 var kategori_penjualan = $option.attr("data-kategori-penjualan");
                 if (kategori_penjualan === '1') {
                     $(".kategori_penjualan_class").val("pcs");
                 } else {
                     $(".kategori_penjualan_class").val("kg");
                 }

                 var stok_sistem = $option.attr("data-stok-database");
                 $("#stok_sistem").val(stok_sistem);

                 var id_barang = $option.attr("data-id-barang");
                 $("#FInput_IdBarang").val(id_barang);

                 var stok_awal = $option.attr("data-stok-awal");
                 $("#FInput_DataStokBarang").val(stok_awal);

                 var nama_barang = $option.attr("data-stok-nama");
                 $("#FInput_NamaBarang").val(nama_barang);

                 var gokil = kategori_penjualan / 10;
                 console.log(gokil);
                 console.log($("#harga").val());
                 console.log($("#harga").attr('placeholder'));
                 console.log($("#FInput_IdBarang").attr('value'));
                 // END
                 console.log(kategori_penjualan);
                 console.log($("#harga").attr('data-cadangan-value'));

                 // If Else Kalo Dia Nominal Pembelian atau Kuantitas Pembelian
                 // 1 = Kuantitas Pembelian || 2 = Nominal Pembelian
                 if (kategori_penjualan === '1') {
                     $('.ganti_downg').html("Kuantitas Pembelian");
                     $(" #tombol_harga ").hide(); // bantuan inputan harga
                 } else {
                     $('.ganti_downg').html("Nominal Pembelian");
                     $(" #tombol_harga ").show();
                     //$('#harga').prop('disabled', false);
                 }

             }
             // END//

             //Button Opname //
             $('#tanggal_dipilih').on('input change', function() {
                 if ($(this).val() != '' && $("#stok_fisik").val() != '' && $("#stok_masuk").val() !=
                     '') {
                     $('#buttonOpname').prop('disabled', false);
                 } else {
                     $('#buttonOpname').prop('disabled', true);
                 }
             });
             //END //

             // //
             $('#stok_fisik').on('input change', function() {
                 if ($(this).val() != '' && $("#tanggal_dipilih").val() != '' && $("#stok_masuk")
                     .val() !=
                     '') {
                     $('#buttonOpname').prop('disabled', false);
                 } else {
                     $('#buttonOpname').prop('disabled', true);
                 }
             });

             $('#stok_masuk').on('input change', function() {
                 if ($(this).val() != '' && $("#stok_fisik").val() != '' && $("#tanggal_dipilih")
                     .val() !=
                     '') {
                     $('#buttonOpname').prop('disabled', false);
                 } else {
                     $('#buttonOpname').prop('disabled', true);
                 }
             });
             // //

             // //
             $(document).on('click', '#buttonOpname', function(e) {
                 e.preventDefault();
                 $("#NamaBarangModal").val($("#FInput_NamaBarang").val());
                 $("#PeriodeBarangModal").val($("#tanggal_dipilih").val());
                 $("#StokFisikModal").val($("#stok_fisik").val());
                 $("#StokMasukModal").val($("#stok_masuk").val());
             });

             // // 
             // Tambah data Opname //
             $(document).on('click', '#TambahkanOpnameModal', function(e) {
                 e.preventDefault();
                 StokAwal_KeDB = parseFloat($('#stok_fisik').val()) + parseFloat($('#stok_masuk').val());
                 StokAwal_DariDB = $("#FInput_DataStokBarang").val();
                 var tambahDataOpname = {
                     'AddDO_Tanggal': $('#tanggal_dipilih').val(),
                     'AddDO_IdBarang': $('#FInput_IdBarang').val(),
                     'AddDO_StokSistem': $('#stok_sistem').val(),
                     'AddDO_StokFisik': $('#stok_fisik').val(),
                     'AddDO_StokMasuk': $('#stok_masuk').val(),
                     'AddDO_StokAwal': StokAwal_DariDB,
                 }
                 console.log(tambahDataOpname);
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });

                 $.ajax({
                     type: "POST",
                     url: "/post-dataStockOpname",
                     data: tambahDataOpname,
                     dataType: "json",
                     success: function(response) {
                         console.log(response.errors);
                         if (response.status == 400) {
                             $('#saveform_errListOpname').show();
                             $('#saveform_errListOpname').html("");
                             $('#saveform_errListOpname').addClass('alert alert-danger');
                             $.each(response.errors, function(key, err_values) {
                                 $('#saveform_errListOpname').append('<li>' +
                                     err_values +
                                     '</li>');
                             });
                             setTimeout(function() {
                                 $('#saveform_errListOpname').fadeOut('fast');
                             }, 1000);
                         } else {
                             /*   $('#modalTambah').modal('hide');
                               $('#modalTambah').find('input').val(""); */
                             TampilkanStockOpname();
                             $('#modalOpname').modal('hide');
                             toastr.success(response.msg);
                         }

                     }
                 });

                 var id_barangOpname = $('#FInput_IdBarang').val();
                 var dataStockBarangOpname = {
                     'AddDO_StokAwalKeDB': StokAwal_KeDB,
                 }
                 console.log(dataStockBarangOpname);

                 if ($("#FormCheckSimpanStok").prop("checked")) {
                     $.ajax({
                         type: "PUT",
                         url: "/update-stockBarangOpname/" + id_barangOpname,
                         data: dataStockBarangOpname,
                         dataType: "json",
                         success: function(response) {}
                     });
                 }
             });

             // END

             /*              $('#modalOpname').on('hidden.bs.modal', function() {
                              $('#saveform_errListOpname').hide();
                          }); */

             // Edit Opname
             $(document).on('click', '#editBtnOpname', function(e) {
                 e.preventDefault();
                 var id_DataOpname = $(this).val();
                 console.log(id_DataOpname);
                 $.ajax({
                     type: "GET",
                     url: "edit-DataOpname/" + id_DataOpname,
                     success: function(response) {
                         //console.log(response);
                         if (response.status == 404) {
                             $('modalNotif').modal('show');
                             $('#success_message').html("");
                             $('#success_message').addClass('alert alert-danger');
                             $('#success_message').text(response.message);
                         } else {
                             $('#NamaBarangModalEditOpname').val(response.EditDataOpname.barang
                                 .nama);
                             $('#IdBarangModalEditOpname').val(response.EditDataOpname
                                 .barang_id);
                             $('#PeriodeBarangModalEditOpname').val(response.EditDataOpname
                                 .opname_date);
                             $('#EditStokFisikModal').val(response.EditDataOpname.stok_fisik);
                             $('#EditStokMasukModalEditOpname').val(response.EditDataOpname
                                 .stok_masuk);
                             $('.kategori_penjualan_classEdit').val(response.EditDataOpname
                                 .barang.kategori_penjualan.kategori_penjualan);
                             $('#EditStokSistemModalEditOpname').val(response.EditDataOpname
                                 .stok_sistem);
                             $('#EditStokAwalModalEditOpname').val(response.EditDataOpname
                                 .stok_awal);
                             $('#EditOpname_DB_id').val(id_DataOpname);
                         }
                     }
                 })
             });

             $(".OpnameManualStok input").on("change", function(e) {
                 const kaloCheck = e.currentTarget.checked;
                 if (kaloCheck) {
                     $('#EditStokAwalModalEditOpname').prop('disabled', false);
                     $('#EditStokSistemModalEditOpname').prop('disabled', false);
                 } else {
                     $('#EditStokAwalModalEditOpname').prop('disabled', true);
                     $('#EditStokSistemModalEditOpname').prop('disabled', true);
                 }
             });

             $(document).on('click', '#EditOpnameModal', function(e) {
                 e.preventDefault();
                 $(this).text("Updating");
                 var Opname_DB_id = $('#EditOpname_DB_id').val();
                 var data = {
                     'stok_fisik': $('#EditStokFisikModal').val(),
                     'stok_masuk': $('#EditStokMasukModalEditOpname').val(),
                     'stok_awal': $('#EditStokAwalModalEditOpname').val(),
                     'stok_sistem': $('#EditStokSistemModalEditOpname').val(),
                 }
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });
                 $.ajax({
                     type: "PUT",
                     url: "/update-DataOpname/" + Opname_DB_id,
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
                             //$('#EditOpnameModal').text("Update Data");
                         } else {
                             $('#updateform_errList2').html("");
                             $('#success_message').html("");
                             $('#success_message').addClass('alert alert-success');
                             $('#success_message').text(response.message);

                             $('#modalOpnameEdit').modal('hide');
                             $('#EditOpnameModal').text("Update Data");
                             TampilkanStockOpname();
                             $(".OpnameManualStok input").prop('checked', false);
                             $("#FormCheckPerbaharuiStok").prop('checked', false);
                             toastr.success(response.message);
                         }
                     }
                 });

                 var id_EditBarangOpname = $('#IdBarangModalEditOpname').val();
                 var newUpdateScript = parseFloat($('#EditStokFisikModal').val()) + parseFloat($(
                     '#EditStokMasukModalEditOpname').val());
                 var dataEditStockBarangOpname = {
                     //  'EditStockAwal': $('#EditStokAwalModalEditOpname').val(),
                     //  'EditStockSistem': $('#EditStokSistemModalEditOpname').val(),

                     //  'EditStockAwal': $('#EditStokFisikModal').val(),
                     //  'EditStockSistem': $('#EditStokMasukModalEditOpname').val(),

                     'EditStockAwal': newUpdateScript,
                     'EditStockSistem': newUpdateScript,

                 }
                 if ($("#FormCheckPerbaharuiStok").on("checked")) {
                     console.log("cekk");
                     console.log(dataEditStockBarangOpname);
                     $.ajax({
                         type: "PUT",
                         url: "/update-EditStockBarangOpname/" + id_EditBarangOpname,
                         data: dataEditStockBarangOpname,
                         dataType: "json",
                         success: function(response) {
                             toastr.success(response.message);
                         }
                     });
                 }
             });

             $('#modalOpnameEdit').on('hidden.bs.modal', function() {
                 $(".OpnameManualStok input").prop('checked', false);
                 $('#EditStokAwalModalEditOpname').prop('disabled', true);
                 $('#EditStokSistemModalEditOpname').prop('disabled', true);
                 $("#FormCheckPerbaharuiStok").prop('checked', false);
             });

             $(document).on('click', '#hapusBtnOpname', function(e) {
                 e.preventDefault();
                 var id_DataOpname = $(this).val();
                 $.ajax({
                     type: "GET",
                     url: "edit-DataOpname/" + id_DataOpname,
                     success: function(response) {
                         //console.log(response);
                         if (response.status == 404) {
                             $('modalNotif').modal('show');
                             $('#success_message').html("");
                             $('#success_message').addClass('alert alert-danger');
                             $('#success_message').text(response.message);
                         } else {
                             $('#DeleteStokSistemModalEditOpname').val(response.EditDataOpname
                                 .stok_sistem);
                             $('#DeleteStokAwalModalEditOpname').val(response.EditDataOpname
                                 .stok_awal);
                             $('#IdBarangStokSistemModalEditOpname').val(response.EditDataOpname
                                 .barang_id); //Untuk update reverse data stok barang
                             $('#HapusOpname_DB_id').val(id_DataOpname);
                         }
                     }
                 })
             });

             $(document).on('click', '#DeleteOpnameModal', function(e) {
                 e.preventDefault();

                 $(this).text("Deleting");
                 var id_OpnameDelete = $('#HapusOpname_DB_id').val();

                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });

                 $.ajax({
                     type: "DELETE",
                     url: "delete-DataOpnameDelete/" + id_OpnameDelete,
                     success: function(response) {
                         $('#modalOpnameHapus').modal('hide');
                         $('#DeleteOpnameModal').text("Delete Data");
                         TampilkanAtauRefreshStockOpname();
                         toastr.success(response.message);
                     }

                 });
                 var id_ReverseBarangOpname = $('#IdBarangStokSistemModalEditOpname').val();
                 var dataReverseStockBarangOpname = {
                     'EditStockAwal': $('#DeleteStokAwalModalEditOpname').val(),
                     'EditStockSistem': $('#DeleteStokSistemModalEditOpname').val(),
                 }
                 if ($("#FormCheckReverseStok").on("checked")) {
                     console.log("cekk reverse");
                     $.ajax({
                         type: "PUT",
                         url: "/update-EditStockBarangOpname/" + id_ReverseBarangOpname,
                         data: dataReverseStockBarangOpname,
                         dataType: "json",
                         success: function(response) {
                             toastr.success(response.message);
                         }
                     });
                 }

             });
             //
         });
     </script>
     <!-- END -->
