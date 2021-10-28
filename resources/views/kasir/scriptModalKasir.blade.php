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

             //
             passIdNota();
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

             $(document).on('click', '#btnTesto', function(e) {
                 e.preventDefault();
                 $("#fInput_notaId").val(null);
                 $("#fInput_notaId").val("xixi");
                 console.log($("#fInput_notaId").val());
                 passIdNota();
             });



             // ======== //
             $(document).on('click', '#btnTempPenjualan', function(e) {
                 e.preventDefault();

                 if ($("#fInput_penjualanId").val() === '1') {
                     let harga = $("#harga").val();
                     let kuantitas = $("#input_perhitungan").val();
                     let sub_total = harga * kuantitas;
                     $("#fInput_hargaJadi").val(harga);
                     $("#fInput_massaPieces").val(kuantitas);
                     $("#fInput_subTotal").val(sub_total);

                     console.log($("#fInput_hargaJadi").val());
                     console.log($("#fInput_massaPieces").val());
                     console.log($("#fInput_subTotal").val());

                 } else {
                     let harga = $("#harga").val();
                     let sub_total = $("#input_perhitungan").val();
                     let kuantitas = sub_total / harga;
                     $("#fInput_hargaJadi").val(harga);
                     $("#fInput_subTotal").val(sub_total);
                     $("#fInput_massaPieces").val(kuantitas);

                     console.log($("#fInput_hargaJadi").val());
                     console.log($("#fInput_massaPieces").val());
                     console.log($("#fInput_subTotal").val());

                 }

                 var tambahDataTempPenjualan = {
                     'add_idBarang': $('#fInput_id_Barang').val(),
                     'add_hargaJadi': $('#fInput_hargaJadi').val(),
                     'add_massaPieces': $('#fInput_massaPieces').val(),
                     'db_massaPieces': $('#option_data').attr('data-stok-database'),
                     'add_penjualanId': $('#fInput_penjualanId').val(),
                     'add_akunId': $('#fInput_akunId').val(),
                     'add_subTotal': $('#fInput_subTotal').val(),
                     'add_notaId': $('#fInput_notaId').val(),
                 }
                 console.log(tambahDataTempPenjualan);

                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });

                 $.ajax({
                     type: "POST",
                     url: "/cashier",
                     data: tambahDataTempPenjualan,
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
                             /*  $('#modalTambah').modal('hide');
                              $('#modalTambah').find('input').val(""); */
                             $('#tabelTempPenjualan').DataTable().ajax.reload(null, false);
                             toastr.success(response.msg);
                         }

                     }
                 });

             });

             $(document).on('click', '#hapusBtnTempPengeluaran', function(e) {
                 e.preventDefault();

                 var id_tempPenjualanDelete = $(this).val();
                 //alert(id_tempPenjualanDelete);
                 $('#delete_DTempPenjualan_id').val(id_tempPenjualanDelete);

             });

             $(document).on('click', '#delete_data_tempPenjualan', function(e) {
                 e.preventDefault();

                 $(this).text("Deleting");
                 var id_tempPenjualanDelete = $('#delete_DTempPenjualan_id').val();
                 //console.log(id_akunDelete);

                 $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });

                 $.ajax({
                     type: "DELETE",
                     url: "/delete-dataTempPenjualan/" + id_tempPenjualanDelete,
                     success: function(response) {
                         console.log(response);
                         $('#modalHapus').modal('hide');
                         $('#delete_data_tempPenjualan').text("Delete Data");
                         //fetchDataBarang(); 
                         $('#tabelTempPenjualan').DataTable().ajax.reload(null, false);
                         toastr.error(response.message);

                     }

                 })
             });
         });
     </script>
     <!-- END -->
