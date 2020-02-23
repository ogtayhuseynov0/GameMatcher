@extends('layout.master')
@section('section')
<div class="container">
    <div class="section">
        <div class="row">
            <div class="col s2  hide-on-med-and-down stick">
                <div class="collection">

                    <a href="#" class="collection-item"><i class="fa fa-list-alt fa-1x"></i> Sport Feed</a>
                    <div class="collection-item "><b>My Teams</b></div>
                    @if(count($arr)> 0)
                        @foreach($arr as $ar1)
                            <a href="club/{{$ar1->id}}" class="collection-item"><i class="fa fa-futbol-o fa-1x"></i> {{$ar1->name}}</a>
                        @endforeach
                    @endif
                    {{--<a href="#" class="collection-item"><i class="fa fa-futbol-o fa-1x"></i> ThatFuture</a>--}}
                    {{--<a href="#" class="collection-item"><i class="fa fa-shopping-basket fa-1x"></i> QaraTeam</a>--}}
                </div>
            </div>
            <div class="col s12 m12 l6 offset-l3">
                {{--<div class="row " style=" margin: 0 1% 1%; border-radius: 2px;">--}}
                    {{--<div class="card">--}}
                        {{--<div class="card-content">--}}
                                {{--<span class="card-title center">Full Time</span>--}}
                            {{--<div class="divider" style="margin-bottom: 2px"></div>--}}
                            {{--<div class="row center">--}}
                                {{--<div class="col s5"><h5>ThatFuture </h5></div>--}}
                                {{--<div class="col s2"><h5>vs</h5></div>--}}
                                {{--<div class="col s5"><h5 class=""> QaraTeam</h5></div>--}}
                            {{--</div>--}}
                            {{--<div class="row center">--}}
                                {{--<div class="col s5"><h5>4 </h5></div>--}}
                                {{--<div class="col s2"><h5>-</h5></div>--}}
                                {{--<div class="col s5"><h5 class=""> 2</h5></div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                {{--</div>--}}
                @if(!empty($fpst))
                    @foreach($fpst as $post)

                        @if(array_key_exists('text',$post))
                        <div class="row " style=" margin: 0 1% 1%; border-radius: 2px;">
                                <div class="card">
                                    <div class="card-content">
                                                <span class="card-title"><a href="{{url('club/'.$post['club_id'])}}">{{\App\Club::find($post['club_id'])->name}}</a>
                                                    <p class="" style="font-size: 15px"><i
                                                                class="fa fa-clock-o material-icons"
                                                                aria-hidden="true"></i> {{$post['created_at']}}</p></span>
                                        <div class="divider" style="margin-bottom: 2px"></div>
                                        @if($post['imagePath']!=null)
                                            <img src="{{asset('images/'.$post['imagePath'])}}"
                                                 class="responsive-img materialboxed">
                                            <div class="divider"  style="margin: 2px"></div>
                                        @endif
                                        <p>
                                            {{$post['text']}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="row " style=" margin: 0 1% 1%; border-radius: 2px;">

                                <div class="card">
                                    <div class="card-image">
                                        <img src="{{asset('images/soccer-stadium-.jpg')}}" class="responsive-img">
                                        <span class="card-title">Match Announcement</span>


                                    </div>
                                    <div class="card-content">
                                        <div class="row center">
                                            <div class="col s5"><h5><a href="{{url('club/'.$post['club_idx'])}}">
                                                        {{\App\Club::find($post['club_idx'])->name}}</a></h5></div>
                                            <div class="col s2"><h5>vs</h5></div>
                                            <div class="col s5"><h5 class=""> <a href="{{url('club/'.$post['club_idy'])}}">
                                                        {{\App\Club::find($post['club_idy'])->name}}
                                                    </a></h5></div>
                                        </div>
                                        <div class="row center">
                                            <p><i class="fa fa-map-marker material-icons"
                                                  aria-hidden="true"></i>  {{$post['location']}}</p><br>
                                            <p><i class="fa fa-clock-o material-icons"
                                                  aria-hidden="true"></i>  {{$post['mtime']}} </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endif
                    @endforeach
                    @else
                        <div class="row">
                            <div id="card-alert" class="card blue darken-3">
                                <div class="card-content white-text">
                                    <p>You are currently not following any club or followed clubs have not posted anything.
                                        You can find clubs through search, schedule and suggested clubs.
                                    </p>
                                </div>
                            </div>
                        </div>
                @endif
            </div>
            <div class="col s2  offset-s7 hide-on-med-and-down stick">
                <div class="collection">
                    <div class="collection-item"><b>Actions</b></div>
                    <a href="{{route('cmatch')}}" class="collection-item"><i class="fa fa-futbol-o fa-1x"></i> Create Match</a>
                    <a href="{{route('cclub')}}" class="collection-item"><i class="fa fa-creative-commons fa-1x"></i> Create Team</a>
                    <div class="collection-item"><b>Suggested Teams</b></div>
                    <!--                    Slider Buttons-->
                    <a class="btn-floating waves-effect waves-light teal " id="leftS"
                       onclick="$('.slider').slider('prev');"
                       style="position: fixed; margin-top: 60px; margin-left: 12%; z-index: 9999"><i
                                class="fa fa-angle-right material-icons"></i></a>

                    <a class="btn-floating waves-effect waves-light teal" id="rightS"
                       onclick="$('.slider').slider('next');"
                       style="position: fixed; margin-top: 60px; margin-left: 0%; z-index: 9999"><i
                                class="fa fa-angle-left famaterial-icons"></i></a>
                    <!--    -------------------------  Begin SLider-->
                    <div class="slider">
                        <ul class="slides mainslide" id="mainslide">
                            @foreach($sarr as $sclub)
                                <li>
                                    <a href="club/{{$sclub["id"]}}">
                                        @if($sclub["logopath"]!=null)
                                            <img src="{{asset($sclub["logopath"])}}">
                                        @else
                                            <img src="{{asset('images/background2.jpg')}}">
                                        @endif
                                    </a>
                                    <div class="caption center-align black-text white">
                                        <h6>{{$sclub["name"]}}</h6>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <!--                    End SLider-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection