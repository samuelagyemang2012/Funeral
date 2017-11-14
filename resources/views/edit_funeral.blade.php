@extends('master')

@section('load_map')
    <script>
        window.addEventListener('load',
                function () {
                    initAutocomplete();
                }, false);
    </script>
@endsection

@section('content')
    <div class="container">
        <br>
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
                    </div>
                </div>
                <div class="col-sm-2"></div>
            </div>

        </center>
    </div>
    <br><br>
    <div class="container">
        <div class="row">

            <div class="col-sm-1"></div>

            <div class="col-sm-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Funeral Details</div>

                    <div class="panel-body">
                        <form method="post" action="{{route("edit")}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">

                                <input hidden name='id' type="text" value="{{$data->fid}}">

                                <div class="col-sm-4">
                                    <div>
                                        <label>
                                            Name
                                        </label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{$data->name}}" required>
                                    </div>
                                    <br>

                                </div>

                                <div class="col-sm-4">
                                    <div>
                                        <label>
                                            Name of Deceased
                                        </label>
                                        <input type="text" class="form-control" id="deceased_name"
                                               value="{{$data->deceased_name}}" name="deceased_name"
                                               required>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div>
                                        <label>
                                            Age of Deceased
                                        </label>
                                        <input type="number" class="form-control" value="{{$data->deceased_age}}"
                                               id="age"
                                               name="age" required>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-4">
                                    <div>
                                        <label>
                                            Brochure
                                        </label>
                                        <input type="file" class="form-control" id="brochure" name="brochure"
                                               value="{{$data->brochure}}">
                                    </div>
                                    <br>

                                    <div>
                                        <label>
                                            Funeral Time
                                        </label>
                                        <input type="time" class="form-control" id="funeral_time" name="funeral_time"
                                               value="{{$data->time}}" required>
                                    </div>
                                    <br>
                                </div>

                                <div class="col-sm-4">
                                    <div>
                                        <label>
                                            Funeral Location
                                        </label>
                                        <input type="text" class="form-control" id="location" name="funeral_location"
                                               value="{{$data->funeral_location}}" required>
                                    </div>
                                    <br>

                                    <div>
                                        <label>
                                            Funeral Date
                                        </label>
                                        <input type="date" class="form-control" id="date" name="funeral_date"
                                               value="{{$data->date}}" required>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div>
                                        <label>
                                            Attire
                                        </label>
                                        <input type="text" class="form-control" id="attire" name="attire"
                                               value="{{$data->attire}}" required>
                                    </div>
                                    <br>
                                </div>

                                <div class="col-sm-4">
                                    <br>
                                    {{--<label>--}}
                                    {{--Wake-keeping--}}
                                    {{--</label>--}}
                                    <select name="wk" class="form-control" required>
                                        <option value="0">No Wake-Keeping</option>
                                        <option value="1">Wake-Keeping</option>
                                    </select>
                                </div>

                            </div>
                            <hr>

                            <div class="row">

                                <div class="col-sm-4">
                                    <label>
                                        Wake-keeping Date
                                    </label>
                                    <input class="form-control" type="date" id="wkd"
                                           value="{{$data->wake_keeping_date}}" name="wake_keeping_date">
                                </div>

                                <div class="col-sm-4">

                                    <label>
                                        Wake-keeping Time
                                    </label>
                                    <input class="form-control" type="time" id="wkt" name="wake_keeping_time"
                                           value="{{$data->wake_keeping_time}}">
                                </div>


                                <div class="col-sm-4">

                                    <label>
                                        Wake-keeping Location
                                    </label>
                                    <input class="form-control" type="text" id="wkl"
                                           name="wake_keeping_location"
                                           value="{{$data->wake_keeping_location}}">
                                </div>
                                <br>
                            </div>

                            <div class="row">
                                <br>
                                <div class="col-sm-12">
                                    <div>
                                        <label>
                                            Information
                                        </label>

                                        <textarea rows="8" id="information" name="information" required
                                                  class="form-control">{{$data->information}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <br>
                                <div class="col-sm-6">
                                    <div>
                                        <label>
                                            Latitude
                                        </label>

                                        <input readonly id="latitude" name="latitude" class="form-control"
                                               value="{{$data->latitude}}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div>
                                        <label>
                                            Longitude
                                        </label>

                                        <input readonly id="longitude" name="longitude" class="form-control"
                                               value="{{$data->longitude}}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <br>
                                <input type="text" id="pac-input">

                                <div class="col-sm-12">
                                    <label>Set location</label><br>
                                    <input id="pac-input" class="controls" type="text" placeholder="Search Box">
                                    <div id="map"></div>

                                    <br>
                                    <button type="submit" class="btn btn-primary btn-lg">Update</button>

                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-1"></div>
        </div>
    </div>

@endsection

@section('scripts')

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7efeQppkHUBcOHrEso7Am2klq_b-ooYM&libraries=places&callback=initAutocomplete"
            async defer></script>
@endsection