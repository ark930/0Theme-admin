<html>
<head>
    <title>Zero Admin</title>
    @yield('css')
    <link rel="stylesheet/less" type="text/css" href="{{ asset('lib/style.less') }}" />
</head>
<body>

@yield('header')

@yield('content')

<script src="{{ asset('lib/less.min.js') }}" type="text/javascript"></script>

@yield('js')

</body>
</html>