<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>GameMatcher find your opponent.</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="{{ asset('css/font-awesome.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="{{ asset('css/style.css') }}" type="text/css" rel="stylesheet" media="screen,projection"/>
    <style>
        .login-sec{
            margin-top: 3%;
        }
    </style>
</head>
<body>


@include('layout.loginMenu')
@yield('section')

<!--  Scripts-->
<script src="{{ asset('js/jquery-2.1.1.js') }}"></script>
<script src="{{ asset('js/materialize.js') }}"></script>
<script src="{{ asset('js/init.js') }}"></script>

@yield('extra_script')
</body>
</html>
