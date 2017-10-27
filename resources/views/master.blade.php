<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Bootstrap -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{asset("js/myscript.js")}}"></script>


    @yield('load_map')


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset("css/mycss.css")}}">
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    <!-- Theme style -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
{{----}}

<nav class="nav navbar-default">
    <ul class="nav navbar-nav">
        {{--<li><a href="/jireh/profile"><b class="thead">My Loans</b></a></li>--}}
        <li><a class="btn" href=""><b class="thead">My Funerals</b></a></li>
        <li><a class="btn" href="{{route("show_add_funeral")}}"><b class="thead">Add Funeral</b></a></li>

    </ul>

    <ul style="float: right" class="nav navbar-nav">
        {{--<li><a href="/jireh/profile"><b class="thead">My Loans</b></a></li>--}}
        <li><a class="btn" href="/"><b class="thead">Logout</b></a></li>

    </ul>
</nav>

<div>
    @yield('content')
</div>

</body>

@yield('scripts')
</html>