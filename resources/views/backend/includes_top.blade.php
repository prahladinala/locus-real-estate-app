<!-- all the css files -->
  @if(get_frontend_settings('favicon'))
  <link rel="icon" href="{{ asset('public/assets/uploads/logo/'.get_frontend_settings('favicon')) }}">
  @else
  <link rel="icon" href="{{ asset('public/assets/global/images/logo/favicon.png') }}">
  @endif
<!-- Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/backend/vendors/bootstrap-5.1.3/css/bootstrap.min.css') }}"
/>

<!--Custom css-->
<link
  rel="stylesheet"
  type="text/css"
  href="{{ asset('public/assets/backend/css/swiper-bundle.min.css') }}"
/>
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/backend/css/main.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/backend/css/custom.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/backend/css/style.css') }}" />
<!-- Datepicker css -->
<link rel="stylesheet" href="{{ asset('public/assets/backend/css/daterangepicker.css') }}" />
<!-- Select2 css -->
<link rel="stylesheet" href="{{ asset('public/assets/backend/css/select2.min.css') }}" />
<link rel="stylesheet" href="{{ asset('public/assets/backend/css/nice-select.min.css') }}" />

<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/backend/css/fontawesome-all.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/backend/font-awesome-icon-picker/fontawesome-iconpicker.min.css') }}" />

<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/backend/vendors/bootstrap-icons-1.8.1/bootstrap-icons.css') }}"/>

<!-- Summernote CSS -->
<link href="{{ asset('public/assets/backend/vendors/summernote-0.8.18-dist/summernote-lite.min.css') }}" rel="stylesheet" />

<!--Toaster css-->
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/backend/css/toastr.min.css') }}"/>

<!-- Calender css -->
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/backend/calender/main.css') }}"/>

<!--Main Jquery-->
<script src="{{ asset('public/assets/global/js/jquery-3.7.1.min.js') }}"></script>


