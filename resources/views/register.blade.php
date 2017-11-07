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
<nav class="nav navbar-default">
    <ul style="float: right" class="nav navbar-nav">
        {{--<li><a href="/jireh/profile"><b class="thead">My Loans</b></a></li>--}}
        <li><a class="btn" href="/"><b class="thead">Login</b></a></li>

    </ul>
</nav>
<div class="container">

    <br><br>
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
                        <div class="alert alert-danger">
                            <p>{{ session('status1') }}</p>
                        </div>
                    @endif

                </div>

                @if (session('status'))
                    <div class="alert alert-succes">
                        <p>{{ session('status') }}</p>
                    </div>
                @endif

                @if (session('status1'))
                    <div class="alert alert-danger">
                        <p>{{ session('status1') }}</p>
                    </div>
                @endif
            </div>
            <div class="col-sm-2"></div>

        </div>

    </center>
    {{--<br><br><br>--}}
    <div class="panel panel-default">
        <div class="panel-heading">Sign Up</div>
        <div class="panel-body">
            <div class="row">
                <form method="post" action="{{route('register')}}">
                    {{csrf_field()}}
                    <div class="col-sm-1"></div>

                    <div class="col-sm-3">
                        <div>
                            <label>First name</label>
                            <input type="text" class="form form-control" name="first_name" value="{{old("first_name")}}"
                                   required>
                        </div>
                        <br>
                        <div>
                            <label>Location</label>
                            <input type="text" class="form form-control" name="location" value="{{old("location")}}"
                                   required>
                        </div>
                        <br>

                        <div>
                            <label>Telephone</label>
                            <input type="number" class="form form-control" name="telephone" value="{{old("telephone")}}"
                                   required>
                        </div>
                    </div>

                    <div class="col-sm-3">

                        <div>
                            <label>Last name</label>
                            <input type="text" class="form form-control" name="last_name" value="{{old("last_name")}}"
                                   required>
                        </div>
                        <br>

                        <div>
                            <label>Address</label>
                            <input type="text" class="form form-control" name="address" value="{{old("address")}}"
                                   required>
                        </div>
                        <br>

                        <div>
                            <label>Password</label>
                            <input type="password" class="form form-control" name="password" required>
                        </div>

                        <br><br>
                        <div>
                            <button style="float: right" class="btn btn-primary btn-lg">Submit</button>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div>
                            <label>Gender</label>
                            <select class="form form-control" required name="gender">
                                <option></option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>
                        <br>
                        <div>
                            <label>Email</label>
                            <input type="email" class="form form-control" name="email" value="{{old("email")}}"
                                   required>
                        </div>
                        <br>

                        <div>
                            <label>Confirm Password</label>
                            <input type="password" class="form form-control" name="cpassword" required>
                        </div>
                    </div>

                    <div class="col-sm-1"></div>
                </form>
            </div>
            <br><br>
        </div>
    </div>
</div>
</body>
</html>
{{--dawdwaada--}}