<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- ============ DEFINE YOUR TITLE HERE ================ --}}
    <title>
        @yield('header-title', config('app.name'))
    </title>


    <!-- plugins:css -->
    <link rel="stylesheet" href={{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/vendors/css/vendor.bundle.base.css') }}>
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href={{ asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}>
    <link rel="stylesheet" href={{ asset('assets/vendors/jvectormap/jquery-jvectormap.css') }}>
    <!-- End plugin css for this page -->
    <!-- Layout styles -->
    <link rel="stylesheet" href={{ asset('assets/css/demo/style.css') }}>
    <!-- End layout styles -->
    <link rel="shortcut icon" href={{ asset('assets/images/favicon.png') }} />

    {{-- ============ WANT TO PUT EXTRA CODE IN HEADER? USER THIS ================ --}}
    @yield('header-code')
</head>

<body>
    <script src={{ asset('assets/js/preloader.js') }}></script>
