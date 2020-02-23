@extends('layout.master')

@section('section')

    <div class="container">
        <div class="section">
            <div class="row">
                <div class="col s12 ">
                    <div class="card">
                        <div class="card-image">
                            @if($club['coverpath']!=null)
                                <img src="{{asset('images/'.$club['coverpath'])}}" class="responsive-img"
                                     style="">
                                <img src="{{asset('images/'.$club['logopath'])}}"
                                     class="responsive-img logo"
                                     style="height: 50%; width: 25%; border-radius: 100%; border: 3px solid white;
                            position:absolute; margin: 28% auto auto;">

                                @else
                                <img src="{{asset('images/background2.jpg')}}" class="responsive-img"
                                     style="">
                                <img src="{{asset('images/background2.jpg')}}"
                                     class="responsive-img logo"
                                     style="height: 50%; width: 25%; border-radius: 100%; border: 3px solid white;
                            position:absolute; margin: 28% auto auto;">
                            @endif
                        </div>
                        <div class="card-content center">
                            <a href="" class="collection-item"><h4>{{$club->name}} ID#{{$club->id}}</h4></a>
                            <a href="{{route('profind',$owner->id)}}" class="collection-item ">Created by {{$owner->name}}</a><br/>
                            <a href="" class="collection-item">Created at {{$club->created_at->format('Y-m-d')}}</a>


                        </div>
                        <div class="card-action center">
                            @if(\Illuminate\Support\Facades\Auth::user()->id==$owner->id)
                                <a href="{{url('club/'.$club->id.'/edit')}}" class="btn">Edit</a>
                                <a href="{{url('club/'.$club->id.'/post')}}" class="btn">Post</a>
                                <div class="chip fcount">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                    <p class=""></p>
                                </div>

                            @else
                                @if($isCmember)
                                    <div class="chip fcount">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                        <p class=""></p>
                                    </div>

                                @else
                                        <a id="flwBtn"
                                                {{--href="{{route('ufllw',$club->id)}}"--}}
                                                        href=""
                                                onclick="event.preventDefault();unfollow({{$club->id}})"
                                                class="btn red">Unfollow</a>

                                        <a
                                                id="unflwBtn"
                                                {{--href="{{route('fllw',$club->id)}}"--}}
                                                onclick="event.preventDefault();follow({{$club->id}})"
                                           class="btn">Follow</a>
                                    <div class="chip fcount">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                    </div>

                                @endif
                            @endif
                        </div>
                        <div class="card-tabs">
                            <ul class="tabs tabs-fixed-width">
                                <li class="tab"><a href="#test4">TimeLine</a></li>
                                <li class="tab"><a class="" href="#test5">About</a></li>
                            </ul>
                        </div>

                        <div class="card-content">
                            <div id="test4">
                                @if(empty($clubPosts))
                                    <div class="row center text-accent-1" >
                                        There is not post records!!
                                    </div>
                                    @else
                                        @foreach($clubPosts as $post)
                                            <div class="row " style=" margin: 0 1% 1%; border-radius: 2px;">
                                                <div class="card">
                                                    <div class="card-content">
                                            <span class="card-title">{{$club->name}}
                                                <p class="" style="font-size: 15px"><i
                                                            class="fa fa-clock-o material-icons"
                                                            aria-hidden="true"></i> {{$post['created_at']}}</p></span>
                                                        <div class="divider" style="margin-bottom: 2px"></div>
                                                        @if($post['imagePath']!=null)
                                                            <img src="{{asset('images/'.$post['imagePath'])}}"
                                                                 class="responsive-img materialboxed">
                                                            <div class="divider"></div>
                                                        @endif
                                                        <p>
                                                            {{$post['text']}}
                                                        </p>
                                                    </div>
                                                    @if(\Illuminate\Support\Facades\Auth::user()->id==$owner->id)
                                                        <div class="card-action">
                                                            <a href="{{route('epost',[$club->id,$post['id']])}}" class="btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                            <form method="POST" action="{{route('dpost',[$club->id,$post['id']])}}" id="delp" class="right " style="margin-bottom: 5px">
                                                                {{csrf_field()}}
                                                                {{method_field("DELETE")}}
                                                                <button type="submit" class="btn red"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    <div class="row center">
                                        {{$clubPosts->links()}}
                                    </div>

                                @endif


                            </div>
                            <div id="test5">
                                <div class="row">
                                    <div class="col s12" style="padding: 10px">
                                        <ul class="collection with-header">
                                            <li class="collection-header center"><h5>Members</h5></li>

                                            @foreach($mainusers as $user)
                                                @if($user['id']==$owner->id)
                                                    <li class="collection-item">
                                                        <div><a href="{{route('profind',$user['id'])}}">{{$user['name']}} {{$user['surname']}}</a>
                                                            <a class="secondary-content ">Creator</a>
                                                        </div>
                                                    </li>
                                                @else
                                                    <li class="collection-item">
                                                        <div>
                                                            <a href="{{route('profind',$user['id'])}}">{{$user['name']}} {{$user['surname']}}</a>
                                                        </div>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('extra_script')
<script>
    var scid= {{$club->id}};
    function follow(s) {
        $.ajax({
            type:'GET',
            url: s+'/follow',
            success:function (data) {
                console.log(data);
                tt()
            }
        });
    }
    function unfollow(s) {
        $.ajax({
            type:'GET',
            url: s+'/unfollow',
            success:function (data) {
                console.log(data);
                tt()
            }
        });
    }
    function  tt() {
        $.ajax({
            type:'GET',
            url: scid+'/isfollowing',
            success:function (data) {
                console.log(data);
                if (data.localeCompare('true')==0){
                    $('#flwBtn').removeClass('hide');
                    $('#unflwBtn').addClass('hide');
                    setFcount();
                }else {
                    $('#flwBtn').addClass('hide');
                    $('#unflwBtn').removeClass('hide');
                    setFcount();
                }
            }
        });
    }
    tt();
    function setFcount() {
        $.ajax({
            type:'GET',
            url: scid+'/followCount',
            success:function (data) {
                console.log(data);
                $('.fcount')[0].innerHTML='<i class="fa fa-users" aria-hidden="true"></i> '+data;
            }
        });
    }

//    setInterval(tt,500);
</script>
@endsection