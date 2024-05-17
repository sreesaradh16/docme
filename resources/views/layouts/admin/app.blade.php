<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('layouts.admin.common.header')

@vite(['resources/sass/app.scss', 'resources/js/app.js'])
@stack("vite")

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('layouts.admin.common.navbar')
        @include('layouts.admin.common.sidemenu')
        <div class="content-wrapper">
            @include("layouts.admin.common.pageheader")
            @include("layouts.includes.alert_message")
            @yield('content')
        </div>
        @include('layouts.admin.common.footer')
    </div>
</body>

</html>