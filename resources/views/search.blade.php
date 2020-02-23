@extends('layout.master')
@section('section')
<div class="container">
    <!--    search bar-->
    <div class="row">
        <div class="col s12">
            <form method="POST" action="{{route("searchid")}}" class="form-horizontal" id="sform" name="sform">
                {{csrf_field()}}
            {{method_field("POST")}}
            <div class="input-field col s11">
                <input type="text" name="query" id="autocomplete-input" class="autocomplete" required>
                <label for="autocomplete-input">Search for</label>
            </div>
            <div class="input-field col s1">
                <button type="submit" id="ssub" class="btn hide"><i class="fa fa-search"></i></button>
                <a href="" class="hoverable" onclick="event.preventDefault();document.getElementById('sform').submit();"> <i class="fa fa-search fa-2x teal-text"></i></a>
            </div>
            </form>
        </div>

    </div>
    <!-- tabs for categorizing result-->
    <div class="row">
        <div class="col s12">
            <ul class="tabs tabs-fixed-width">
                <li class="tab col s3"><a href="#test1" class="active">All</a></li>
                <li class="tab col s3"><a href="#test2">Clubs</a></li>
                <li class="tab col s3 "><a href="#test3">Players</a></li>
            </ul>
        </div>
        <div id="test1" class="col s12">
            <div class="row">

                <ul class="collection">
                    @if(isset($arr))
                        @foreach($arr as $ar)
                            @if(array_key_exists("email",$ar))
                                <li class="collection-item avatar Player">
                                    <img src="{{asset('images/lilly.jpg')}}" alt="" class="circle">
                                    <a href="profile/{{$ar["id"]}}"><span class="title">{{$ar["name"]}} {{$ar["surname"]}}</span></a>
                                    <p>Player</p>
                                </li>

                                @else
                                <li class="collection-item avatar Club">
                                    @if(isset($ar["logopath"]))
                                        <img src="{{asset('images/'.$ar["logopath"])}}" alt="" class="circle">

                                    @else
                                        <img src="{{asset('images/background2.jpg')}}" alt="" class="circle">
                                    @endif
                                    <a href="club/{{$ar["id"]}}"><span class="title">{{$ar["name"]}} </span></a>
                                    <p>Club <br></p>
                                </li>
                            @endif
                        @endforeach
                        @else
                        <li class="row s6 center">
                            No result found
                        </li>
                    @endif
                    {{--<li class="collection-item avatar Club">--}}
                        {{--<img src="images/yuna.jpg" alt="" class="circle">--}}
                        {{--<span class="title">Title</span>--}}
                        {{--<p>First Line <br></p>--}}
                        {{--<a href="#!" class="secondary-content btn">--}}
                            {{--Follow</a>--}}
                    {{--</li>--}}
                    {{--<li class="collection-item avatar Player">--}}
                        {{--<img src="images/yuna.jpg" alt="" class="circle">--}}
                        {{--<span class="title">Title</span>--}}
                        {{--<p>First Line </p>--}}

                        {{--<a href="#!" class="secondary-content btn">--}}
                            {{--Message</a>--}}
                    {{--</li>--}}
                </ul>
            </div>
        </div>
        <div id="test2" class="col s12">
            <ul class="collection">
                @if(isset($arr))
                    @foreach($arr as $ar)
                        @if(array_key_exists("email",$ar))
                        @else
                            <li class="collection-item avatar Club">
                                @if(isset($ar["logopath"]))
                                    <img src="{{asset('images/'.$ar["logopath"])}}" alt="" class="circle">

                                @else
                                    <img src="{{asset('images/background2.jpg')}}" alt="" class="circle">
                                @endif
                                <a href="club/{{$ar["id"]}}"><span class="title">{{$ar["name"]}} </span></a>
                                <p>Club <br></p>
                            </li>
                        @endif
                    @endforeach
                @else
                    <li class="row s6 center">
                        No result found
                    </li>
                @endif
            </ul>
        </div>
        <div id="test3" class="col s12">
            <ul class="collection">
                @if(isset($arr))
                    @foreach($arr as $ar)
                        @if(array_key_exists("email",$ar))
                            <li class="collection-item avatar Player">
                                <img src="{{asset('images/lilly.jpg')}}" alt="" class="circle">
                                <a href="profile/{{$ar["id"]}}"><span class="title">{{$ar["name"]}} {{$ar["surname"]}}</span></a>
                                <p>Player</p>

                            </li>

                        @else
                        @endif
                    @endforeach
                @else
                    <li class="row s6 center">
                        No result found
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
@endsection

@section('extra_script')
<script>
    $(document).ready(function () {
        $('input.autocomplete').autocomplete({
            data: {
//                "Apple": null,
//                "Appled": null,
//                "Appleasdasdasd": null,
//                "Microsoft": null,
//                "Google": 'https://placehold.it/250x250'
            },
            limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
            onAutocomplete: function (val) {
                // Callback function when value is autcompleted.
            },
            minLength: 1 // The minimum length of the input for the autocomplete to start. Default: 1.
        });
    })
</script>
@endsection