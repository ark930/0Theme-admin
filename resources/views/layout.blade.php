<html>
<head>
    <title>Zero Admin</title>
    @yield('css')
    <link rel="stylesheet/less" type="text/css" href="{{ asset('lib/style.less') }}" />
    @yield('head_script')
</head>
<body>

@yield('header')

@yield('content')

<script src="{{ asset('lib/less.min.js') }}" type="text/javascript"></script>

@yield('js')

@if($errors->count() > 0)
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
    <script>
        $(function() {
            alert("{!! $errors->first() !!}");
        });
    </script>
@endif
</body>
</html>