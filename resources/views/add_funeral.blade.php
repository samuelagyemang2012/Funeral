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
                        <form method="post" action="{{route("add_funeral")}}">
                            {{csrf_field()}}
                            <div class="row">

                                <div class="col-sm-4">
                                    <div>
                                        <label>
                                            Name
                                        </label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{old('name')}}" required>
                                    </div>
                                    <br>

                                </div>

                                <div class="col-sm-4">
                                    <div>
                                        <label>
                                            Name of Deceased
                                        </label>
                                        <input type="text" class="form-control" id="deceased_name"
                                               value="{{old('deceased_name')}}" name="deceased_name"
                                               required>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div>
                                        <label>
                                            Age of Deceased
                                        </label>
                                        <input type="number" class="form-control" value="{{old('age')}}" id="age"
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
                                               value="{{old('brochure')}}" required>
                                    </div>
                                    <br>

                                    <div>
                                        <label>
                                            Time
                                        </label>
                                        <input type="time" class="form-control" id="time" name="time"
                                               value="{{old('time')}}" required>
                                    </div>
                                    <br>
                                </div>

                                <div class="col-sm-4">
                                    <div>
                                        <label>
                                            Location
                                        </label>
                                        <input type="text" class="form-control" id="location" name="location"
                                               value="{{old('location')}}" required>
                                    </div>
                                    <br>

                                    <div>
                                        <label>
                                            Date
                                        </label>
                                        <input type="date" class="form-control" id="date" name="date"
                                               value="{{old('date')}}" required>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div>
                                        <label>
                                            Attire
                                        </label>
                                        <input type="text" class="form-control" id="attire" name="attire"
                                               value="{{old('attire')}}" required>
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
                                    <input  class="form-control" type="date" id="wkd"
                                           value="{{old('wake_keeping_date')}}" name="wake_keeping_date"
                                           required>
                                </div>

                                <div class="col-sm-4">

                                    <label>
                                        Wake-keeping Time
                                    </label>
                                    <input  class="form-control" type="time" id="wkt" name="wake_keeping_time"
                                           value="{{old('wake_keeping_time')}}" required>
                                </div>


                                <div class="col-sm-4">

                                    <label>
                                        Wake-keeping Location
                                    </label>
                                    <input  class="form-control" type="text" id="wkl"
                                           name="wake_keeping_location"
                                           value="{{old('wake_keeping_location')}}" required>
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
                                                  class="form-control">{{old('information')}}</textarea>
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
                                               value="{{old('latitude')}}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div>
                                        <label>
                                            Longitude
                                        </label>

                                        <input readonly id="longitude" name="longitude" class="form-control"
                                               value="{{old('longitude')}}">
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
                                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>

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