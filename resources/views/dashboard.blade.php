@extends('master')

@section('content')

    <br>
    <div class="container">
        <div class="row">
            <div class="col-sm-4"></div>

            <div class="col-sm-4">
                @if (session('status'))
                    <div class="alert alert-success">
                        <p>{{ session('status') }}</p>
                    </div>
                @endif
            </div>

            <div class="col-sm-4"></div>
        </div>

    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <br>
                <!--left col-->
                <ul class="list-group">
                    <li class="list-group-item text-muted" contenteditable="false">Welcome</li>

                    <li class="list-group-item text-right"><strong class=""><span
                                    style="float: left">Profile</span></strong><span>{{$name}}</span>
                    </li>

                    <li class="list-group-item text-right"><strong class=""><span
                                    style="float: left">My funerals</span></strong><span>{{$num}}</span>
                    </li>

                    {{--<li class="list-group-item text-right"><strong class=""><span--}}
                    {{--style="float: left">Make a Poster</span></strong><span>{{$num}}</span>--}}
                    {{--</li>--}}

                </ul>

            </div>

            <div class="col-sm-1">
                {{--<br>--}}
                {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Panel Heading</div>--}}
                {{--<div class="panel-body">Panel Content</div>--}}
                {{--</div>--}}
            </div>

            <div class="col-sm-8">

                {{--@foreach()--}}
                <br>
                @if($num == 0)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <center><h4><b></b></h4></center>
                        </div>
                        <div class="panel-body">
                            <b>No funerals yet !</b>
                        </div>
                    </div>
                @endif


                @foreach($data as $funeral)
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            <center><h4><b>{{$funeral->name}}</b></h4></center>
                        </div>
                        <div class="panel-body">
                            <div class="row">

                                <div class="col-sm-4">
                                    <b>Deceased</b>: {{$funeral->deceased_name}}
                                </div>

                                <div class="col-sm-4">
                                    <b>Age</b>: {{$funeral->deceased_age}} &nbsp; years
                                </div>

                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-12">
                                    <b>Information:</b>
                                    <p>{{$funeral->information}}</p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">

                                <div class="col-sm-4">
                                    <b>Funeral Location</b>: {{$funeral->funeral_location}}
                                </div>

                                <div class="col-sm-4">
                                    <b>Funeral
                                        Date</b>: {{date('jS F Y', strtotime(str_replace('-','/', $funeral->date)))}}
                                </div>

                                <div class="col-sm-4">
                                    <b>Funeral Time</b>: {{$funeral->time}}
                                </div>
                            </div>
                            <hr>

                            <div class="row">

                                <div class="col-sm-4">
                                    <b>Attire</b>: {{$funeral->attire}}
                                </div>

                                <div class="col-sm-4">
                                    {{$funeral->wake_keeping== 0 ? 'There will be no wake keeping.':''}}                                </div>
                            </div>
                            <hr>

                            <div class="row">

                                <div class="col-sm-12">
                                    <iframe width="100%" height="450" frameborder="0" style="border:0"
                                            src="https://www.google.com/maps/embed/v1/place?q={{$funeral->latitude}},{{$funeral->longitude}}&amp;key=AIzaSyDg2Ze7xPzEzAcfGbsEhqIJV5KHxmqhklA"></iframe>
                                </div>
                            </div>
                            <button class="btn btn-primary">Edit</button>
                        </div>
                        {{--<br>--}}
                    </div>
                @endforeach
                {{ $data->links() }}

            </div>
        </div>
    </div>
@endsection
