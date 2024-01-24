<script src="{{ asset('public/assets/global/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('public/assets/customer/vendors/bootstrap-5.1.3/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/assets/customer/js/fontawesome.all.min.js') }}"></script>

<script src="{{ asset('public/assets/customer/vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('public/assets/customer/js/custom.js') }}"></script>
<script src="{{ asset('public/assets/customer/js/moment.min.js') }}"></script>
<script src="{{ asset('public/assets/customer/js/daterangepicker.min.js') }}"></script>
<script src="{{ asset('public/assets/global/vendors/summernote-0.8.18-dist/summernote-lite.min.js') }}"></script>
<script src="{{ asset('public/assets/global/js/toastr.min.js') }}"></script>
<script src="{{ asset('public/assets/global/js/jQuery.tagify.js') }}"></script>
<script src="{{ asset('public/assets/customer/js/multiple-image-video.js') }}"></script>

<script src="{{ asset('public/assets/customer/vendors/uploader/jquery.uploader.min.js') }}"></script>

<!-- Recaptcha -->
@if(get_settings('recaptcha_status')==1)
  <script src="{{ asset('public/assets/global/vendors/recaptcha/api.js') }}"></script>
@endif


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