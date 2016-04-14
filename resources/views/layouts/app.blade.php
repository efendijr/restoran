<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link rel="shortcut icon" href="{{ asset('favicon-send.ico') }}" >

    <!-- Fonts -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'> -->
    <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.css" type='text/css'>

    <!-- Styles -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css"> -->
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <link rel="stylesheet" href="/bower_components/bootstrap/dist/css/bootstrap.css" type='text/css'>
    <link rel="stylesheet" href="/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.css" type='text/css'>
    <link rel="stylesheet" href="/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css">

    <style>
        @font-face {
            font-family: FontAwesome;
            src: url(/bower_components/font-awesome/fonts/fontawesome-webfont.woff);
            }


        body {
            font-family: 'FontAwesome';
        }

        .fa, .btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                @yield('branding')

            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                
                <!-- Left Side Of Navbar -->
                @yield('navbarLeft')

                <!-- Right Side Of Navbar -->
                @yield('navbarRight')

            </div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timeago/1.5.2/jquery.timeago.min.js"></script> -->
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script> -->
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    <script src="/bower_components/jquery/dist/jquery.js"></script>
    <script src="/bower_components/bootstrap/dist/js/bootstrap.js"></script>
    <script src="/bower_components/jquery-timeago/jquery.timeago.js"></script>
    <script src="/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.js"></script>
    <script src="/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

    <script>
        $(function(){
            window.App = {
                init: function() {
                    this.timeago();
                },

                timeago: function() {
                    $("time").timeago();
                }
            };
            App.init()
        });
    </script>

</body>
</html>
