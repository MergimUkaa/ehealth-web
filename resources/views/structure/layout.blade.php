<!DOCTYPE html>
<html lang="en">
<head>
    <title>e-Health | @yield('title')</title>
    @include('structure.head')
    @yield('page-styles')
</head>
<body>
@include('structure.header')



@yield('content')



@include('structure.footer')
@include('structure.scripts')
@yield('page-scripts')
</body>
</html>