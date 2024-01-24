@if(get_frontend_settings('favicon'))
<link rel="icon" href="{{ asset('public/assets/uploads/logo/'.get_frontend_settings('favicon')) }}">
@else
<link rel="icon" href="{{ asset('public/assets/global/images/logo/favicon.png') }}">
@endif

<!-- Font Awesome CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/customer/vendors/fontawesome/fontawesome.css') }}" />

<!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/customer/vendors/bootstrap-5.1.3/css/bootstrap.min.css') }}" />

<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/customer/vendors/select2/select2.min.css') }}" />

<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/customer/vendors/uploader/jquery.uploader.css') }}" />

<!-- Style css -->
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/customer/css/style.css') }}" />

<!-- Custom css -->
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/customer/css/custom.css') }}" />

<!--Toaster css-->
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/global/css/toastr.min.css') }}" />

<!-- Summernote CSS -->
<link rel="stylesheet" href="{{ asset('public/assets/global/vendors/summernote-0.8.18-dist/summernote-lite.min.css') }}" />

<!-- Map css-->
<link rel="stylesheet" href="{{ asset('public/assets/global/css/mapbox-gl.css') }}">
<link rel="stylesheet" href="{{ asset('public/assets/global/css/mapbox-gl-geocoder.css') }}">
<script src="{{ asset('public/assets/global/js/mapbox-gl.js') }}"></script>
<script src="{{ asset('public/assets/global/js/mapbox-gl-geocoder.min.js') }}"></script>