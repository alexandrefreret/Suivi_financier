<html>
    <head>
        <title>{{ $title ?? 'Dashboard' }}</title>

        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    </head>
    <body>
        {{ $slot }}

        <script type="text/javascript" src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    </body>
</html>