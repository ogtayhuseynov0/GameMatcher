@extends('layout.master')

@section('section')
    <div class="container" style="">

        <div class="row">
            <div class="col s12 m6 l6" style="padding: 10px;">
                <div class="panel panel-default cclub" style="margin-top: 20px">
                    <div class="card-title center">
                        Update Club
                    </div>
                    <div class="panel-body">
                        <div class="text-success"></div>
                        <form class="form-horizontal" method="POST" action="{{route('cupdate',$club->id)}}"
                        enctype="multipart/form-data">
                            {{method_field('PUT')}}
                            {{ csrf_field() }}

                            <input type="hidden" name="user_id"
                                   value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                            <div class="form-group{{ $errors->has('name') ? ' invalid' : '' }} col s12">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{$club->name}}" required>
                                    @if ($nameexist)
                                        <span class="help-block invalid red-text">
                                        <strong>Given Name already is taken</strong>
                                    </span>
                                        @else
                                        @if ($errors->has('name'))
                                            <br/>
                                            <span class="help-block invalid red-text">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col s12">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" name="submit">
                                        Update Name
                                    </button>
                                    <a href="/club/{{$club->id}}" class="btn right">
                                        Back
                                    </a>
                                </div>
                            </div>
                        </form>
                        <form class="form-horizontal" method="POST" action="{{route('cupdate',$club->id)}}"
                              enctype="multipart/form-data">
                            {{method_field('PUT')}}
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('coverpath') ? ' invalid' : '' }} col s12"
                                 style="margin-top: 2%; margin-bottom: 2%">
                                <label for="coverpath" class="col-md-4 control-label">Cover</label>

                                <div class="">
                                    <input id="coverpath" type="file" class="form-control" name="coverpath"
                                           value="{{$club->coverpath}}">

                                    @if ($errors->has('coverpath'))
                                        <br/>
                                        <span class="help-block invalid red-text">
                                        <strong>{{ $errors->first('coverpath') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        <div class="form-group col s12">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" name="submit">
                                    Update Cover
                                </button>
                            </div>
                        </div>
                        </form>
                        <form class="form-horizontal" method="POST" action="{{route('cupdate',$club->id)}}"
                              enctype="multipart/form-data">
                            {{method_field('PUT')}}
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('logopath') ? ' invalid' : '' }} col s12"
                                 style="margin-bottom: 2%">
                                <label for="logopath" class="col-md-4 control-label">Logo</label>

                                <div class="">
                                    <input id="logopath" type="file" class="form-control" name="logopath"
                                           value="{{$club->logopath}}">

                                    @if ($errors->has('logopath'))
                                        <br/>
                                        <span class="help-block invalid red-text">
                                        <strong>{{ $errors->first('logopath') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        <div class="form-group col s12">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" name="submit">
                                    Update Logo
                                </button>
                            </div>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col s12 m6 l6" style="padding: 10px">
                <div class="panel panel-default cclub" style="margin-top: 20px">
                    <div class="card-title center">
                        Add Club Members
                    </div>
                    <div class="card-content">
                        <form class="form-horizontal" method="POST" action="{{route('addusr',$club->id)}}">
                            {{ csrf_field() }}

                            <input type="hidden" name="club_id" value="{{$club->id}}">
                            <div class="form-group{{ $errors->has('user_id') ? ' invalid' : '' }} col s12">
                                <label for="user_id" class="col-md-4 control-label">User ID</label>

                                <div class="">
                                    <input id="user_id" type="text" class="form-control" name="user_id" required>

                                    @if($exist)
                                        <span class="help-block invalid red-text">
                                        <strong>User does not exist!</strong>
                                    </span>

                                    @else
                                        @if($isMember)
                                            <span class="help-block invalid red-text">
                                         <strong>User is already member!</strong>
                                          </span>
                                        @endif
                                        @if($isFree)
                                            <span class="help-block invalid red-text">
                                            <strong>Max 11 user allowed!</strong>
                                            </span>
                                        @else
                                            @if ($errors->has('user_id') || $exist )
                                                <span class="help-block invalid red-text">
                                                 <strong>{{ $errors->first('user_id') }} User already is member.</strong>
                                                </span>
                                            @endif
                                        @endif
                                    @endif

                                </div>
                            </div>
                            <div class="form-group col s12">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" name="submit">
                                        Add Player
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12" style="padding: 10px">
                        <ul class="collection with-header">
                            <li class="collection-header center"><h5>Members</h5></li>

                            @foreach($mainusers as $user)
                                @if($user['id']==\Illuminate\Support\Facades\Auth::user()->id)
                                    <li class="collection-item">
                                        <div><a href="{{route('profind',$user['id'])}}">{{$user['name']}} {{$user['surname']}}</a>
                                            <a class="secondary-content ">Creator</a>
                                        </div>
                                    </li>
                                @else
                                    <li class="collection-item">
                                        <div>
                                            <a href="{{route('profind',$user['id'])}}">{{$user['name']}} {{$user['surname']}}</a>
                                            <form method="POST" action="{{route('removeUsr',[$club->id,$user['id']])}}"
                                                  class="right">
                                                {{csrf_field()}}
                                                {{method_field("DELETE")}}
                                                <button type="submit" class="btn red"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                                            </form>
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

@endsection