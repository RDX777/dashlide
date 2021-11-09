<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url(mix('css/bootstrap/bootstrap.css')) }}">
    <link rel="stylesheet" href="{{ url(mix('css/bootstrap/bootstrap-icons.css')) }}">

    <title>@yield('title')</title>

</head>
<body class="FundoPreto">

    @yield('content')

    <script src="{{ url(mix('js/bootstrap/bootstrap.js')) }}"></script>

</body>
</html>