@extends('layout.master')

@section('section')
    <div class="container">
        <div class="row" style="margin-top: 5px">
            @foreach($mts as $mt)
                <div class="row " style=" margin: 0 1% 1%; border-radius: 2px;">

                    <div class="card">
                        <div class="card-content">
                            <div class="row center">
                                <div class="col s5"><h5><a href="{{url('club/'.$mt['club_idx'])}}">
                                            {{\App\Club::find($mt['club_idx'])->name}}</a></h5></div>
                                <div class="col s2"><h5>vs</h5></div>
                                <div class="col s5"><h5 class=""> <a href="{{url('club/'.$mt['club_idy'])}}">
                                            {{\App\Club::find($mt['club_idy'])->name}}
                                        </a></h5></div>
                            </div>
                            <div class="row center">
                                <p><i class="fa fa-map-marker material-icons"
                                      aria-hidden="true"></i>  {{$mt['location']}}</p><br>
                                <p><i class="fa fa-clock-o material-icons"
                                      aria-hidden="true"></i>  {{$mt['mtime']}} </p>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
            <div class="row center">
                    {{$mts->links()}}
            </div>

        </div>
    </div>
@endsection