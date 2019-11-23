<!DOCTYPE html>
<html lang="en">
<head>
    <title>e-Health | @yield('title')</title>
    @include('structure.head')
    @yield('page-styles')
</head>
<body>
@include('structure.header')

<main id="app">
    @yield('content')
</main>

@include('structure.footer')
@include('structure.scripts')

@yield('page-scripts')
</body>
</html>
