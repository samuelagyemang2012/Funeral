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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
<div class="container">
    <br><br><br><br><br>
    <center>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div>
                    @if(count($errors))
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('status1'))
                        <div class="alert alert-success">
                            <p>{{ session('status1') }}</p>
                        </div>
                    @endif

                </div>

                @if (session('status'))
                    <div class="alert alert-danger">
                        <p>{{ session('status') }}</p>
                    </div>
                @endif
            </div>
            <div class="col-sm-2"></div>

        </div>

    </center>
    <div class="row">
        <div class="col-sm-4"></div>

        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">Sign In</div>
                <div class="panel-body">
                    <form class="" method="post" action="{{route('login')}}">
                        {{csrf_field()}}
                        <div>
                            <input type="text" class="form-control" placeholder="Email" name="email" required>
                        </div><br>

                        <div>
                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                        </div><br>


                        <button class="btn btn-primary btn-block" type="submit">
                            Sign in
                        </button>
                    </form>
                </div>

                <a href="{{route("show_register")}}" class="text-center new-account">Create an account </a>
                <br>
            </div>

            <div class="col-sm-4"></div>
        </div>
    </div>
</div>
</body>
</html>
{{--dawdwaada--}}