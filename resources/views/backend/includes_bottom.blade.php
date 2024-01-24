<!--Bootstrap bundle with popper-->
<script src="{{ asset('public/assets/backend/vendors/bootstrap-5.1.3/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/assets/backend/js/swiper-bundle.min.js') }}"></script>
<!-- Datepicker js -->
<script src="{{ asset('public/assets/backend/js/moment.min.js') }}"></script>
<script src="{{ asset('public/assets/backend/js/daterangepicker.min.js') }}"></script>
<!-- Select2 js -->
<script src="{{ asset('public/assets/backend/js/select2.min.js') }}"></script>
<script src="{{ asset('public/assets/backend/js/jquery.nice-select.min.js') }}"></script>

<script src="{{ asset('public/assets/backend/font-awesome-icon-picker/fontawesome-iconpicker.min.js') }}"></script>

<!--Custom Script-->
<script src="{{ asset('public/assets/backend/js/script.js') }}"></script>
<script src="{{ asset('public/assets/backend/js/custom.js') }}"></script>

<!--Summernone Script-->
<script src="{{ asset('public/assets/backend/vendors/summernote-0.8.18-dist/summernote-lite.min.js') }}"></script>




<!--pdf Script-->
<script src="{{ asset('public/assets/backend/js/pdfmake.min.js') }}"></script>


<!--Toaster Script-->
<script src="{{ asset('public/assets/backend/js/toastr.min.js') }}"></script>



<script>

    "use strict";


    @if(Session::has('message'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.success("{{ session('message') }}");
    @endif

    @if(Session::has('error'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.error("{{ session('error') }}");
    @endif

    @if(Session::has('info'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.warning("{{ session('warning') }}");
    @endif
</script>

<script>

    "use strict";
    
    jQuery(document).ready(function(){
        $('input[name="datetimes"]').daterangepicker({

            timePicker: true,
            startDate: moment().startOf('day').subtract(30, 'day'),
            endDate: moment().startOf('day'),
            locale: {
                format: 'M/DD/YYYY '
            }
        });
    });

</script>

@yield('js')
