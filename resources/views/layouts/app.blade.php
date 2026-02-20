<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Helpdesk</title>

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">
</head>

<body>

<div class="container mt-4">
    @yield('content')
</div>

<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/js/app.min.js') }}"></script>

@stack('scripts')

</body>
</html>
