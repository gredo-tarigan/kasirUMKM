     <!-- script CRUD Modal -->
     <script>
         $(document).ready(function() {
             toastr.options.preventDuplicates = true;

             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
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
                         render: $.fn.dataTable.render.number('.', '', 0, 'Rp. '),
                         sWidth: '20%'
                     },
                     {
                         data: 'sub_total',
                         name: 'sub_total',
                         render: $.fn.dataTable.render.number('.', '', 0, 'Rp. '),
                         sWidth: '20%'

                     },
                     {
                         data: 'actions',
                         name: 'actions',
                         orderable: false,
                         searchable: false,
                         sWidth: '10%'
                     },
                 ]

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
                 return data.massa_pieces + " " + data.percobaan; //dari kontroller
             }

             // ======== //

             // == Kode Buat buat untuk kondisi dari option select ==//
             getSelectData($("#selectNamaBarang"));


             $("#selectNamaBarang").change(function() {
                 getSelectData($(this));
             });

             

             function getSelectData(a) {
                 //console.clear();

                 var formatter = new Intl.NumberFormat('id-ID', {
                 style: 'currency',
                 currency: 'IDR',
                 minimumFractionDigits: 0

             });

                 var $option = a.find("option:selected");
                 //var text = $option.text();
                 var text = $option.val();
                 // Coba coba ganti nilai harga
                 var x = $option.attr("data-harga-barang"); // Data harga barang udah dapat gan
                 var gokil = text / 10;
                 $("#harga").attr('placeholder', gokil);
                 $("#harga").attr('value', formatter.format(x));
                 console.log(gokil);
                 console.log(formatter.format(x));
                 console.log($("#harga").val()); // Value nya berhasil diubah
                 // END
                 console.log(text);
                 if (text === '1') {
                     $('.ganti_downg').html("Kuantitas Pembelian");
                     $(" #tombol_harga ").hide();
                 } else {
                     $('.ganti_downg').html("Nominal Pembelian");
                     $(" #tombol_harga ").show();
                 }
             }
             // END -- Belum bisa buat ganti text //
         });
     </script>
     <!-- END -->
