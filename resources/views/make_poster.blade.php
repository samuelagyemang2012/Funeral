@extends('master')

@section('content')

    <div class="container">
        <br>
        <div class="row">
            <div class="col-sm-8">
                <div class="panel panel-default">
                    {{--<div class="panel-heading">--}}
                    {{--<center><h4><b></b></h4></center>--}}
                    {{--</div>--}}
                    <div class="panel-body">
                        <div>
                            <center><h3 id="m-title">Title</h3></center>
                            {{--<input class="form form-control" type="text" id="title">--}}
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-4">
                                <img src="{{asset('uploads/saf.jpg')}}" width="100%">
                            </div>

                            <div class="col-sm-1"></div>

                            <div class="col-sm-4">
                                <h3 id="m_dname">Jack Bauer</h3>

                                <h3 id="m_dage">90</h3>
                            </div>
                            {{--<hr>--}}
                        </div>
                        <hr>

                        <div class="row">

                            <div class="col-sm-12">
                                <h4>Burial Information</h4>
                                <textarea readonly style="border: none; width: 100%" rows="10"
                                          id="m_information"></textarea>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-4">
                                <h5>Funeral Venue</h5>
                            </div>

                            <div class="col-sm-4">
                                <h5>Funeral Time</h5>
                            </div>

                            <div class="col-sm-4">
                                <h5>Attire</h5>
                            </div>
                        </div>

                        <button onclick="javascript:window.print()"></button>

                    </div>
                </div>
            </div>


            <div class="col-sm-4">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <center><h4><b>Enter Funeral Details here</b></h4></center>
                    </div>

                    <div class="panel-body">
                        <div>
                            <label>Title</label>
                            <input class="form form-control" type="text" id="f_title" onkeyup="update_title()">
                        </div>
                        <br>
                        <div>
                            <label>Deceased Name</label>
                            <input class="form form-control" type="text" id="dname" onkeyup="update_deceased_name()">
                        </div>
                        <br>
                        <div>
                            <label>Deceased Age</label>
                            <input class="form form-control" type="text" id="dage" onkeyup="update_deceased_age()">
                        </div>
                        <br>
                        <div>
                            <label>Burial Information</label>
                            <textarea onkeyup="update_info()" rows="4" id="info" class="form form-control"></textarea>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection