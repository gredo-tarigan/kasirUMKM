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
                         mData: format_totalNota,
                         name: 'total'
                     },
                     {
                         data: 'actions',
                         name: 'actions',
                         orderable: false,
                         searchable: false
                     },
                 ]

             });

             function format_totalNota(data) {
                 return formatter.format(data.total);
             }


             table.column(4).visible(0);
             $(".update_data input").on("change", function(e) {
                 const kaloCheck = e.currentTarget.checked;
                 if (kaloCheck) {
                     table.column(4).visible(1);
                 } else {
                     table.column(4).visible(0);
                 }
             });



             // ======== //
             $(document).on('click', '#editBtnPenjualan', function(e) {
                 e.preventDefault();
                 var id_nota_penjualan = $(this).val();


             });

             $(document).on('click', '#update_akunBtn', function(e) {
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
             });

         });
     </script>
     <!-- END -->
