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
             var table = $('#tabelTempPenjualan').DataTable({
                 /* processing: true,
                      info: true, */
                 "paging": false,
                 "ordering": false,
                 "info": false,
                 "searching": false,
                 "scrollY": 200,
                 "scrollX": true,
                 "autoWidth": false,
                 ajax: "{{ route('get.tempPenjualan.list') }}",
                 /*  "pageLength": 5,
                  "aLengthMenu": [
                      [5, 10, 25, 50, -1],
                      [5, 10, 25, 50, "All"]
                  ], */

                 aoColumns: [
                     /* {
                                              data: 'id',
                                              name: 'id'
                                          }, */
                     // {data:'checkbox', name:'checkbox', orderable:false, searchable:false},
                     {
                         data: 'DT_RowIndex',
                         name: 'DT_RowIndex',
                         sWidth: '5%'
                     },
                     {
                         data: 'percobaan2',
                         name: 'barang.nama',
                         sWidth: '30%',
                     },

                     /* {
                         data: 'massa_pieces', //nanti ganti aja nama kolomnya jadi quantity
                         name: 'massa_pieces', // terus digabung sama kategori penjualan buat bikin per piece atau per satuan massa
                         sWidth:'15%'
                     }, */
                     {
                         mData: getMassaPiecesdanKategoriPenjualan, //nanti ganti aja nama kolomnya jadi quantity
                         name: 'massa_pieces', // terus digabung sama kategori penjualan buat bikin per piece atau per satuan massa
                         sWidth: '15%'
                     },
                     {
                         data: 'harga_jadi',
                         name: 'harga_jadi',
                         render: $.fn.dataTable.render.number('.', '', 0, 'Rp '),
                         sWidth: '20%'
                     },
                     {
                         data: 'sub_total',
                         name: 'sub_total',
                         render: $.fn.dataTable.render.number('.', '', 0, 'Rp '),
                         sWidth: '20%'

                     },
                     {
                         data: 'actions',
                         name: 'actions',
                         orderable: false,
                         searchable: false,
                         sWidth: '10%'
                     },
                 ],


             });

             table.column(5).visible(0);
             $(".edit_delete input").on("change", function(e) {
                 const kaloCheck = e.currentTarget.checked;
                 if (kaloCheck) {
                     table.column(5).visible(1);
                 } else {
                     table.column(5).visible(0);
                 }
             });

             /* $(".sidebarToggle").on("click", function(e) {
                $('#tabelTempPenjualan').DataTable().ajax.reload(null, false);
             }); */

             // Fitur keren Datatable menampilkan 2 kolom database dalam 1 kolom tabel
             function getMassaPiecesdanKategoriPenjualan(data, type, dataToSet) {
                 //return data.massa_pieces + "" + data.kategori_penjualan_id;
                 return bulatin(data.massa_pieces, 1) + " " + data.percobaan; //dari kontroller
             }


             // buat ngebulatin angka decimal
             function bulatin(value, precision) {
                 var multiplier = Math.pow(10, precision || 0);
                 return Math.round(value * multiplier) / multiplier;
             }
             // END

             // ======== //

             // == Kode Buat buat untuk kondisi dari option select ==//
             getSelectData($("#selectNamaBarang"));


             $("#selectNamaBarang").change(function() {
                 getSelectData($(this));
             });

             function getSelectData(a) {
                 //console.clear();



                 var $option = a.find("option:selected");
                 var akun_id = '69';
                 $("#fInput_akunId").val(akun_id);
                 var harga_barang = $option.attr("data-harga-barang"); // Data harga barang udah dapat gan
                 $("#harga").attr('placeholder', formatter.format(harga_barang));
                 $("#harga").val(harga_barang);
                 $("#harga").attr('data-cadangan-value', harga_barang);
                 var kategori_penjualan = $option.attr("data-kategori-penjualan");
                 $("#fInput_penjualanId").val(kategori_penjualan);
                 var id_barang = $option.attr("data-id-barang");
                 $("#fInput_id_Barang").val(id_barang);

                 var gokil = kategori_penjualan / 10;
                 console.log(gokil);
                 console.log($("#harga").val());
                 console.log($("#harga").attr('placeholder'));
                 console.log($("#fInput_id_Barang").attr('value'));
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
             // END -- Udah bisa buat ganti text //

             $(".switch input").on("change", function(e) {
                 const isOn = e.currentTarget.checked;
                 var reverseHarga = $("#harga").attr('data-cadangan-value');
                 if (isOn) {
                     $('#harga').prop('disabled', false); // Biar bisa masukin harga manual
                 } else {
                     //console.log("yombray");
                     $("#harga").val(reverseHarga);
                     $('#harga').prop('disabled', true);
                 }
             });


             // Untuk Panggil Total Pembelian
             total_pembelian();

             function total_pembelian() {
                 jQuery.fn.dataTable.Api.register('sum()', function() {
                     return this.flatten().reduce(function(a, b) {
                         if (typeof a === 'string') {
                             a = a.replace(/[^\d.-]/g, '') * 1;
                         }
                         if (typeof b === 'string') {
                             b = b.replace(/[^\d.-]/g, '') * 1;
                         }

                         return a + b;
                     }, 0);
                 });

                 $(function() {
                     //var table = $('#tabelTempPenjualan').DataTable();
                     $('#tabelTempPenjualan').on('draw.dt', function() {
                         var tablesum = table.column(4).data().sum();
                         //$("#total_pembelian").append(tablesum);
                         $("#total_pembelian").html(formatter.format(tablesum));
                     });
                 });
             }
             // END


             // Live Auto Numeric Currency - Felix
             /*  new AutoNumeric('#harga', {
                  allowDecimalPadding: false,
                  currencySymbol: "Rp. ",
                  decimalCharacter: ",",
                  digitGroupSeparator: ".",
                  formatOnPageLoad: false,
              }); */


             // Click Tombol Harga Helper
             $(".yoman").on("click", function() {
                 console.log("aw");
                 var x = $(".yoman").val();
                 $("#input_perhitungan").val(x);
             });



             

             /* $(document).on('click', '#add_data_akun', function(e) {
                 e.preventDefault();
                 var tambahDataAkun = {
                     'add_namaAkun': $('#add_namaAkun').val(),
                     'add_username': $('#add_username').val(),
                     'add_password': $('#add_password').val(),
                     'add_noHpAkun': $('#add_noHpAkun').val(),
                     'add_tipeAkun': $('#add_tipeAkun').val(),
                     'add_alamatAkun': $('#add_alamatAkun').val(),
                 }
                 console.log(tambahDataAkun);



             }); */

                          // Store Data Ke Nota
             $(document).on('click', '#btnNota', function(e) {
                 e.preventDefault();
                 var tambahDataNota = {
                     'add_namaPembeli': $('#nama_pembeli').val(),
                     'add_noNota': $('#no_nota').val(),
                 }
                 $("#nama_pembeli").val(""); // Dikosongkan biar kasir ga lupa ngehapus
                 console.log(tambahDataNota);

                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });

                 $.ajax({
                     type: "POST",
                     url: "/cashier-toNota",
                     data: tambahDataNota,
                     dataType: "json",
                     success: function(response) {
                         //console.log(response.errors);
                         if (response.status == 400) {
                             $('#saveform_errList').html("");
                             $('#saveform_errList').addClass('alert alert-danger');
                             $.each(response.errors, function(key, err_values) {
                                 $('#saveform_errList').append('<li>' +
                                     err_values +
                                     '</li>');
                             });

                         } else {
                             $('#tabelTempPenjualan').DataTable().ajax.reload(null, false);
                             toastr.success(response.msg);
                             passNoNota();
                             passIdNota();
                         }

                     }
                 });

             });

             //
             passNoNota();
             function passNoNota() {
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });

                 $.ajax({
                     type: "POST",
                     url: "/cashier-no_nota",
                     dataType: "json",
                     success: function(response) {
                        var no_nota = "OLALA" + "-" + response.carbon_today + response.test;
                        $("#no_nota").val(no_nota);
                        console.log($("#no_nota").val());
                     }
                 });
             }

             function passIdNota() {
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });

                 $.ajax({
                     type: "POST",
                     url: "/cashier-id_nota",
                     dataType: "json",
                     success: function(response) {
                         $("#fInput_notaId").val(response);
                         console.log($("#fInput_notaId").val());
                     }
                 });
             }
         });
     </script>
     <!-- END -->
