@extends('layout.master')

@section('section')

    <div class="container">
        <div class="row" style="margin-top: 5px">
            @if(count($clubs)==0)
                <div class="row">
                    <div class="card-panel red darken-4">
                        <span class="white-text">You do not own a club.</span>
                        <a href="{{route('cclub')}}" class="btn right" style="margin-bottom: 15px"> Create club </a>

                    </div>
                </div>
               @else
                <div class="col s12 m6 l6 offset-m3 offset-l3">
                    <div class="card darken-1">
                        <div class="card-content">
                            <span class="card-title center">Create Match</span>

                            <div class="row">
                                <form class="form-horizontal" method="POST" action="{{route('rmatch')}}"
                                      style="margin-top: 2%">
                                    {{ csrf_field() }}
                                    <div class="form-group{{ $errors->has('club_idx') ? ' invalid' : '' }} col s12">
                                        <label for="club_idx" class="col-md-4 control-label">Your Club</label>

                                        <div class="input-field ">
                                            <select name="club_idx" id="club_idx" required class="validate ">
                                                <option value="" disabled selected>Choose your Club</option>
                                                @foreach($clubs as $ht)
                                                    <option value="{{$ht->id}}">{{$ht->name}}</option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('club_idx'))
                                                <span class="help-block invalid red-text">
                                               <strong>{{ $errors->first('club_idx') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('club_idy') ? ' invalid' : '' }} col s12">
                                        <label for="text" class="col-md-4 control-label">Opponent Club Name</label>

                                        <div class="input-field ">
                                            <input id="text" type="text" class="form-control validate autocomplete"

                                                   name="club_idy" required placeholder="ex: ThatFuture"/>

                                            @if ($errors->has('club_idy'))
                                                <span class="help-block invalid red-text">
                                               <strong>{{ $errors->first('club_idy') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('day') ? ' invalid' : '' }} col s12">
                                        <label for="day" class="col-md-4 control-label">Day</label>

                                        <div class="col-md-6">
                                            <input type="text" class="datepicker" name="day"  id="day" required>

                                            @if ($errors->has('day'))
                                                <span class="help-block red-text">
                                        <strong>{{ $errors->first('day') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('dtime') ? ' invalid' : '' }} col s12">
                                        <label for="dtime" class="col-md-4 control-label">Time</label>

                                        <div class="col-md-6">
                                            <input type="text" class="timepicker" name="dtime"  id="dtime" required>

                                            @if ($errors->has('dtime'))
                                                <span class="help-block red-text">
                                        <strong>{{ $errors->first('dtime') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('location') ? ' invalid' : '' }} col s12">
                                        <label for="location" class="col-md-4 control-label">Location</label>

                                        <div class="input-field ">
                                            <input id="location" type="text" class="form-control validate"
                                                   name="location" placeholder="ex: 707 Stadium, Metro: Azadliq" required/>

                                            @if ($errors->has('location'))
                                                <span class="help-block invalid red-text">
                                               <strong>{{ $errors->first('location') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col s12" style="margin-top: 2%">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary" name="submit">
                                                Create
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            @endif

        </div>
    </div>


@endsection
@section('extra_script')
    <script>
        var tod=new Date();
        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 1, // Creates a dropdown of 15 years to control year,
            format: 'yyyy-mm-dd',
            min: tod,
            max: tod.setMonth( tod + 1),
            today: 'Today',
            clear: 'Clear',
            close: 'Ok',
            closeOnSelect: false // Close upon selecting a date,
        });
    $.ajax({
        type:'GET',
        url: 'http://lp.com/call',
        success:function (data) {
            console.log(data);
            var sta={};
            for (var i = 0; i < data.length; i++) {
                //console.log(countryArray[i].name);
                sta[data[i]] = null; //countryArray[i].flag or null
            }
            console.log(sta);
            $('input.autocomplete').autocomplete({
                data: sta,
                limit: 10, // The max amount of results that can be shown at once. Default: Infinity.
                onAutocomplete: function (val) {
                    // Callback function when value is autcompleted.

                },
                minLength: 0 // The minimum length of the input for the autocomplete to start. Default: 1.
            });
        }
});
    </script>
@endsection