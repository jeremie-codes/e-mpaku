<!DOCTYPE html>
<html lang="en" class="light scroll-smooth group" data-layout="vertical" data-sidebar="light" data-sidebar-size="lg"
    data-mode="light" data-topbar="light" data-skin="default" data-navbar="sticky" data-content="fluid" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>@yield('title') | {{ env('APP_NAME') }}</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta content="Minimal Admin & Dashboard Template" name="description">
    <meta content="Themesdesign" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('images/logo.png') }}">

    @include('layouts.head-css')
    <!-- Livewire Styles -->
    @livewireStyles
</head>

<!-- Content -->
@yield('content')


<!-- Vendor Script -->
@include('layouts.vendor-scripts')
<!-- Livewire cript -->
@livewireScripts

</body>

</html>
