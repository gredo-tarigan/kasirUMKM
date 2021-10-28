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
             var table = $('#tabelAkun').DataTable({
                 processing: true,
                 info: true,
                 ajax: "{{ route('get.akun.list') }}",
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
                         data: 'nama',
                         name: 'nama'
                     },
                     {
                         data: 'alamat',
                         name: 'alamat'
                     },
                     {
                         data: 'noHp',
                         name: 'noHp'
                     },

                     {
                         data: 'kategori_akun',
                         name: 'kategori_akun'
                     },
                     {
                         data: 'username',
                         name: 'username'
                     },
                     {
                         data: 'actions',
                         name: 'actions',
                         orderable: false,
                         searchable: false
                     },
                 ]

             });

             table.column(4).visible(0);
             table.column(5).visible(0);
             table.column(6).visible(0);
             $(".update_data input").on("change", function(e) {
                 const kaloCheck = e.currentTarget.checked;
                 if (kaloCheck) {
                     table.column(4).visible(1);
                     table.column(5).visible(1);
                     table.column(6).visible(1);
                 } else {
                     table.column(4).visible(0);
                     table.column(5).visible(0);
                     table.column(6).visible(0);
                 }
             });

             // ======== //
             $(document).on('click', '#add_data_akun', function(e) {
                 e.preventDefault();
                 var tambahDataAkun = {
                     'add_namaAkun': $('#add_namaAkun').val(),
                     'add_username': $('#add_username').val(),
                     'add_password': $('#add_password').val(),
                     'add_noHpAkun': $('#add_noHpAkun').val(),
                     'add_kategoriAkun': $('#add_kategoriAkun').val(),
                     'add_alamatAkun': $('#add_alamatAkun').val(),
                 }
                 console.log(tambahDataAkun);

                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });

                 $.ajax({
                     type: "POST",
                     url: "/account",
                     data: tambahDataAkun,
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
                             $('#modalTambah').modal('hide');
                             $('#modalTambah').find('input').val("");
                             $('#tabelAkun').DataTable().ajax.reload(null, false);
                             toastr.success(response.msg);
                         }

                     }
                 });

             });

             $(document).on('click', '#editBtnAkun', function(e) {
                 e.preventDefault();
                 var id_akun = $(this).val();
                 //console.log(id_akun);
                 $.ajax({
                     type: "GET",
                     url: "/edit-dataAkun/" + id_akun,
                     success: function(response) {
                         //console.log(response);
                         if (response.status == 404) {
                             $('modalNotif').modal('show');
                             $('#success_message').html("");
                             $('#success_message').addClass('alert alert-danger');
                             $('#success_message').text(response.message);
                         } else {
                             $('#edit_namaAkun').val(response.editDataAkun.nama);
                             $('#edit_username').val(response.editDataAkun.username);
                             //$('#edit_password').val(response.editDataAkun.password);
                             $('#edit_noHpAkun').val(response.editDataAkun.noHp);
                             //$('#edit_kategoriAkun').val(response.editDataAkun.kategori_akun_id);
                             $('#edit_alamatAkun').val(response.editDataAkun.alamat);
                             $('#edit_DAkun_id').val(id_akun);
                         }
                     }
                 })
             });

             //=======================
             $(document).on('click', '#settingsAkun', function(e) {
                 e.preventDefault();
                 var id_akun = $(this).val();
                 console.log(id_akun);
                  $.ajax({
                     type: "GET",
                     url: "/edit-dataSettingsAkun/" + id_akun,
                     success: function(response) {
                         //console.log(response);
                         if (response.status == 404) {
                             $('modalNotif').modal('show');
                             $('#success_message').html("");
                             $('#success_message').addClass('alert alert-danger');
                             $('#success_message').text(response.message);
                         } else {
                             $('#settingAkun_namaAkun').val(response.editSettingsAkun.nama);
                             $('#settingAkun_username').val(response.editSettingsAkun.username);
                             //$('#edit_password').val(response.editDataAkun.password);
                             $('#settingAkun_noHpAkun').val(response.editSettingsAkun.noHp);
                             $('#settingAkun_kategoriAkun').val(response.editSettingsAkun.kategori_akun_id);
                             $('#settingAkun_alamatAkun').val(response.editSettingsAkun.alamat);
                             $('#settingAkun_DAkun_id').val(id_akun);

                             // Buat nampilin nama kategori akun, karna disini gak dipanggil berdasarkan relasi
                             if ($('#settingAkun_kategoriAkun').val() == 2) {
                                $('#settingAkun_kategoriAkun').html("Owner");
                             } else {
                                $('#settingAkun_kategoriAkun').html("Kasir")
                             }
                         }
                     }
                 });
             });
             //=======================
             // ==========================
             $(document).on('click', '#update_passwordSettingsAkunBtn', function(e) {
                 e.preventDefault();

                 $(this).text("Updating");

                 var id_akun = $('#settingAkun_DAkun_id').val();
                 var data = {
                     'password': $('#settingAkun_password').val(),
                     'password_confirmation': $('#settingAkun_passwordConfirm').val(),
                 }
                 //console.log(data);
                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });
                 $.ajax({
                     type: "PUT",
                     url: "/update-dataPasswordSettingAkun/" + id_akun,
                     data: data,
                     dataType: "json",
                     success: function(response) {
                         //console.log(response);
                         if (response.status == 400) {
                             $('#updateform_errListPassword').html("");
                             $('#updateform_errListPassword').addClass('alert alert-danger');
                             $.each(response.errors, function(key, err_values) {
                                 $('#updateform_errListPassword').append('<li>' +
                                     err_values +
                                     '</li>');
                             });
                             $('#update_passwordSettingsAkunBtn').text("Update Password");

                         } else if (response.status == 404) {
                             $('#updateform_errListPassword').html("");
                             $('#success_message').addClass('alert alert-success');
                             $('#success_message').text(response.message);
                             $('#update_passwordSettingsAkunBtn').text("Update Password");

                         } else {
                             $('#updateform_errListPassword').html("");
                             $('#success_message').html("");
                             $('#success_message').addClass('alert alert-success');
                             $('#success_message').text(response.message);

                             $('#modalSettingAkun').modal('hide');
                             $('#modalNotif').modal('show');
                             $('#update_passwordSettingsAkunBtn').text("Update Password");
                             //fetchDataBarang();
                             //$('#tabelAkun').DataTable().ajax.reload(null, false);
                         }
                     }

                 })


             });
             // ==========================

             $(document).on('click', '#update_akunBtn', function(e) {
                 e.preventDefault();

                 $(this).text("Updating");

                 var id_akun = $('#edit_DAkun_id').val();
                 var data = {
                     'nama_akun': $('#edit_namaAkun').val(),
                     'username': $('#edit_username').val(),
                     //'password': $('#edit_password').val(),
                     'noHp_akun': $('#edit_noHpAkun').val(),
                     'kategori_akun': $('#edit_kategoriAkun').val(),
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
                                 $('#updateform_errList').append('<li>' +
                                     err_values +
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

             // ==========================
             $(document).on('click', '#update_passwordAkunBtn', function(e) {
                 e.preventDefault();

                 $(this).text("Updating");

                 var id_akun = $('#edit_DAkun_id').val();
                 var data = {
                     //'nama_akun': $('#edit_namaAkun').val(),
                     //'username': $('#edit_username').val(),
                     'password': $('#edit_password').val(),
                     'password_confirmation': $('#edit_passwordConfirm').val(),
                     //'noHp_akun': $('#edit_noHpAkun').val(),
                     //'kategori_akun': $('#edit_kategoriAkun').val(),
                     //'alamat_akun': $('#edit_alamatAkun').val(),
                 }
                 //console.log(data);


                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });

                 $.ajax({
                     type: "PUT",
                     url: "/update-dataPasswordAkun/" + id_akun,
                     data: data,
                     dataType: "json",
                     success: function(response) {
                         //console.log(response);
                         if (response.status == 400) {
                             $('#updateform_errListPassword').html("");
                             $('#updateform_errListPassword').addClass('alert alert-danger');
                             $.each(response.errors, function(key, err_values) {
                                 $('#updateform_errListPassword').append('<li>' +
                                     err_values +
                                     '</li>');
                             });
                             $('#update_passwordAkunBtn').text("Update Password");

                         } else if (response.status == 404) {
                             $('#updateform_errListPassword').html("");
                             $('#success_message').addClass('alert alert-success');
                             $('#success_message').text(response.message);
                             $('#update_passwordAkunBtn').text("Update Password");

                         } else {
                             $('#updateform_errListPassword').html("");
                             $('#success_message').html("");
                             $('#success_message').addClass('alert alert-success');
                             $('#success_message').text(response.message);

                             $('#modalEdit').modal('hide');
                             $('#modalNotif').modal('show');
                             $('#update_passwordAkunBtn').text("Update Password");
                             //fetchDataBarang();
                             $('#tabelAkun').DataTable().ajax.reload(null, false);
                         }
                     }

                 })


             });
             // ==========================

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
