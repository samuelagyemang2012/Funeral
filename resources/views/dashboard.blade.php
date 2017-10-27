@extends('master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <br>
                <!--left col-->
                <ul class="list-group">
                    <li class="list-group-item text-muted" contenteditable="false">User Details</li>

                    <li class="list-group-item text-right"><strong class=""><span
                                    style="float: left">Last seen</span></strong><span>Samuel Agyemang</span>
                    </li>

                    <li class="list-group-item text-right"><strong class=""><span
                                    style="float: left">Name</span></strong><span>Sam</span>
                    </li>

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
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading">Panel Heading</div>
                    <div class="panel-body">Panel Content</div>
                </div>
            </div>
        </div>
    </div>
@endsection
