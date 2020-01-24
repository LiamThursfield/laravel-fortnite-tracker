<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.includes.head-meta')
    @include('layouts.includes.head-styles')
</head>
<body>

<div id="app">
    @include('layouts.includes.header')

    <div class="container">
        <div class="eol-notice">
            <i class="fas fa-info-circle"></i>
            Due to API changes, this service stopped updating after Season 9.
        </div>
    </div>

    @yield('content')

    @include('layouts.includes.footer')
</div>

@include('layouts.includes.footer-scripts')

</body>
