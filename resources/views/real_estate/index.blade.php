<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>{{ get_phrase('Real-Estate') }} | {{ get_phrase('Panel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="" />
    <meta  name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    @include('real_estate.include_top')


</head>

<body>

    @include('real_estate.header')

    @yield('content')

    @include('real_estate.footer')

    @include('real_estate.include_bottom')

</body>

</html>
