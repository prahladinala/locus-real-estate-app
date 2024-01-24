<!-- js -->
<script src="{{ asset('public/assets/global/js/jquery-ui.js') }}"></script>
<!-- Bootstrap Js -->
<script src="{{ asset('public/assets/global/js/bootstrap.bundle.min.js') }}"></script>
<!-- Owl Carosule -->
<script src="{{ asset('public/assets/global/js/owl.carousel.min.js') }}"></script>
<!-- Slick Carosule -->
<script src="{{ asset('public/assets/global/js/slick.min.js') }}"></script>
<!-- Magnific Popup Js -->
<script src="{{ asset('public/assets/global/js/jquery.magnific-popup.min.js') }}"></script>
<!-- Nice Select Js -->
<script src="{{ asset('public/assets/global/js/jquery.nice-select.min.js') }}"></script>
<!-- Date Flatpiker js -->
<script src="{{ asset('public/assets/global/js/flatpickr.js') }}"></script>
{{-- Range Slider --}}
<script src="{{ asset('public/assets/real-estate/vendors/rangeslider/rangeslider.min.js') }}"></script>
<!-- VenoBox Js -->
<script src="{{ asset('public/assets/global/js/venobox.min.js') }}"></script>
<!-- Wow Js -->
<script src="{{ asset('public/assets/global/js/wow.min.js') }}"></script>
<!-- Main Js -->
<script src="{{ asset('public/assets/global/js/main.js') }}"></script>
<!-- Toaster Js -->
<script src="{{ asset('public/assets/global/js/toastr.min.js') }}"></script>

<script src="{{ asset('public/assets/global/js/mapbox-gl.js') }}"></script>
<script src="{{ asset('public/assets/global/js/mapbox-gl-geocoder.min.js') }}"></script>
<script src="{{ asset('public/assets/global/js/map.js') }}"></script>
<script src="{{ asset('public/assets/global/js/plyr.js') }}"></script>
<script src="{{ asset('public/assets/global/js/embed.js') }}"></script>

<script type="text/javascript">

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