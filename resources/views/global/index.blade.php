<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('global.seo')

    @include('global.include_top')

</head>

<body>
    <!-- Header Area Start -->
    @include('global.header')
    <!-- Header Area End   -->

    <!-- Body Area Start   -->
    @yield('content')
    <!-- Body Area End   -->

    <!-- Footer  Area Start   -->
    @include('global.footer')
    <!-- Footer Area End   -->

    <!-- Bottom Area Start -->
    @include('global.include_bottom')
    <!-- Bottom Area End   -->

 

</body>

</html>