     <!-- script CRUD Modal -->
     <script>
         $(document).ready(function() {

                     toastr.options.preventDuplicates = true;

                     $.ajaxSetup({
                         headers: {
                             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                         }
                     });

                    // ======== //
                         $(document).on('click', '#btnNota', function(e) {
                             e.preventDefault();
                             console.log($("#no_nota").val());

                         });


                     });
     </script>
     <!-- END -->
