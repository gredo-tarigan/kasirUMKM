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
                 "pageLength": 5,
                 "aLengthMenu": [
                     [5, 10, 25, 50, -1],
                     [5, 10, 25, 50, "All"]
                 ],

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
                         data: 'nama_barang',
                         name: 'nama_barang'
                     },
                     {
                         data: 'hargamasuk_barang',
                         name: 'hargamasuk_barang'
                     },
                     {
                         data: 'hargajual_barang',
                         name: 'hargajual_barang'
                     },
                     {
                         data: 'stok_barang',
                         name: 'stok_barang'
                     },
                     {
                         data: 'supplier_barang',
                         name: 'supplier_barang'
                     },
                     {
                         data: 'ket_barang',
                         name: 'ket_barang'
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
             table.column(7).visible(0);
             $(".update_data input").on("change", function(e) {
                 const kaloCheck = e.currentTarget.checked;
                 if (kaloCheck) {
                     table.column(5).visible(1);
                     table.column(6).visible(1);
                     table.column(7).visible(1);
                 } else {
                     table.column(5).visible(0);
                     table.column(6).visible(0);
                     table.column(7).visible(0);
                 }
             });

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
                             $('#edit_nb').val(response.editDataBarang.nama_barang);
                             $('#edit_hmb').val(response.editDataBarang.hargamasuk_barang);
                             $('#edit_hjb').val(response.editDataBarang.hargajual_barang);
                             $('#edit_stob').val(response.editDataBarang.stok_barang);
                             $('#edit_supb').val(response.editDataBarang.supplier_barang);
                             $('#edit_kb').val(response.editDataBarang.ket_barang);
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



         });
     </script>
     <!-- END -->
