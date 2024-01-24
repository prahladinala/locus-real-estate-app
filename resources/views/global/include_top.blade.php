    <!-- Favicon -->
    @if(get_frontend_settings('favicon'))
    <link rel="icon" href="{{ asset('public/assets/uploads/logo/'.get_frontend_settings('favicon')) }}">
    @else
    <link rel="icon" href="{{ asset('public/assets/global/images/logo/favicon.png') }}">
    @endif
    <!-- Fontawasome Css -->
    <link rel="stylesheet" href="{{ asset('public/assets/global/css/all.min.css') }}">
    <!-- Custome Icon -->
    <link rel="stylesheet" href="{{ asset('public/assets/global/font/flaticon_mycollection.css') }}">
    <!-- Owl Carousel Css -->
    <link rel="stylesheet" href="{{ asset('public/assets/global/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/global/css/owl.theme.default.min.css') }}">
    <!-- Magnific Popup Css -->
    <link rel="stylesheet" href="{{ asset('public/assets/global/css/magnific-popup.css') }}">
    <!-- SLick Carousel Css -->
    <link rel="stylesheet" href="{{ asset('public/assets/global/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/global/css/slick-theme.css') }}">
    <!-- Nice Select Css -->
    <link rel="stylesheet" href="{{ asset('public/assets/global/css/nice-select.css') }}">
    <!-- Flatpiker Css -->
    <link rel="stylesheet" href="{{ asset('public/assets/global/css/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/global/css/dark.css') }}">
    <!-- Range Slider Css -->
    <script src="{{ asset('public/assets/real-estate/vendors/rangeslider/rangeslider.css') }}"></script>
    <!-- VenoBox Css -->
    <link rel="stylesheet" href="{{ asset('public/assets/global/css/venobox.min.css') }}">
    <!-- Animate Css -->
    <link rel="stylesheet" href="{{ asset('public/assets/global/css/animate.css') }}">
    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="{{ asset('public/assets/global/css/bootstrap.min.css') }}">
    <!-- Main Css -->
    <link rel="stylesheet" href="{{ asset('public/assets/global/css/style.css') }}">
    <!-- Real Estate Custom New Css -->
    <link rel="stylesheet" href="{{ asset('public/assets/global/css/real_custom.css') }}">
    <!-- Responsive Css -->
    <link rel="stylesheet" href="{{ asset('public/assets/global/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/global/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/global/css/plyr.css') }}">
    <!--Toaster css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/global/css/toastr.min.css') }}" />
    <!-- js -->
    <script src="{{ asset('public/assets/global/js/jquery-3.7.1.min.js') }}"></script>
    @if(get_settings('recaptcha_status')==1)
     <!-- Recaptcha -->
     <script type="application/javascript" src="{{ asset('public/assets/global/vendors/recaptcha/api.js') }}"></script>
    @endif

    <link rel="stylesheet" href="{{ asset('public/assets/global/css/mapbox-gl.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/global/css/mapbox-gl-geocoder.css') }}">
    <script src="{{ asset('public/assets/global/js/mapbox-gl.js') }}"></script>
    <script src="{{ asset('public/assets/global/js/mapbox-gl-geocoder.min.js') }}"></script>

 

