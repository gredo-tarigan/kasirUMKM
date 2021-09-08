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
            var table = $('#tabelPengeluaran').DataTable({
                processing: true,
                info: true,
                ajax: "{{ route('get.pengeluaran.list') }}",
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
                        data: 'nama_pengeluaran',
                        name: 'nama_pengeluaran'
                    },
                    {
                        data: 'nominal_pengeluaran',
                        name: 'nominal_pengeluaran'
                    },
                    
                    {
                        data: 'kategori_pengeluaran',
                        name: 'kategori_pengeluaran'
                    },
                    {
                        data: 'ket_pengeluaran',
                        name: 'ket_pengeluaran'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data : 'created_at',
                        name : 'created_at',

                    },
                ]

            });

            table.column(3).visible(0);
            table.column(5).visible(0);
            $(".update_data input").on("change", function(e) {
                const kaloCheck = e.currentTarget.checked;
                if (kaloCheck) {
                    table.column(3).visible(1);
                    table.column(5).visible(1);
                } else {
                    table.column(3).visible(0);
                    table.column(5).visible(0);
                }
            });

            // ======== //

            $(document).on('click', '#hapusBtnPengeluaran', function(e) {
                e.preventDefault();
                var id_pengeluaranDelete = $(this).val();
                //alert(id_barangDelete);
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
                            $('#edit_nomp').val(response.editDataPengeluaran.nominal_pengeluaran);
                            $('#edit_kp').val(response.editDataPengeluaran.ket_pengeluaran);
                            $('#edit_katp').val(response.editDataPengeluaran.kategori_pengeluaran);
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
                            toastr.success(response.msg);
                        }

                    }
                });

            });



        });
    </script>
    <!-- END -->
