<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('global.seo')

    @include('customer.include_top')

    <!-- Custom css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/global/css/custom-auth.css') }}" />

</head>
<body>

    <!-- Header Area Start -->
    @include('global.header')
    <!-- Header Area End   -->

    <!-- Body Area Start   -->
    @yield('content')
    <!-- Body Area End   -->

    <!-- Bottom Area Start -->
    @include('global.footer')
    <!-- Bottom Area End   -->

    @include('customer.include_bottom')

</body>
</html>