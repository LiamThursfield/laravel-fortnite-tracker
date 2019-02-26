<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.includes.head-meta')
    @include('layouts.includes.head-styles')
</head>
<body>

<div id="app">
    @include('layouts.includes.header')

    @yield('content')

    @include('layouts.includes.footer')
</div>

@include('layouts.includes.footer-scripts')

</body>
