@extends('layout.master')

@section('section')
    <div class="container">
        <div class="row">
            <div class="col s12 m6 l6 offset-m3 offset-l3">
                <div class="panel panel-default login-sec" style="margin-top: 2%">
                    <div class="panel-title center ">
                        <h5 class="teal-text">Edit Profile</h5>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{route('uupdate',$user->id)}}">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}
                            <div class="form-group{{ $errors->has('name') ? ' invalid' : '' }} col s12 m6 l6">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}"  autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block red-text">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('surname') ? ' invalid' : '' }} col s12 m6 l6">
                                <label for="surname" class="col-md-4 control-label">Surname</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control" value="{{$user->surname}}" name="surname"  >

                                    @if ($errors->has('surname'))
                                        <span class="help-block red-text">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('position') ? ' invalid' : '' }} col s12">
                                <label for="position" class="col-md-4 control-label">Position</label>

                                <div class="col-md-6">
                                    <input id="position" type="text" class="form-control" placeholder="ex: Forward 11, RMF 12" value="{{$user->position}}" name="position"  >

                                    @if ($errors->has('position'))
                                        <span class="help-block red-text">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('gender') ? ' invalid' : '' }} col s12">
                                <label for="gender" class="col-md-4 control-label">Gender</label>

                                <div class="col-md-6">
                                    <select name="gender" required id="gender" >
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    @if ($errors->has('gender'))
                                        <span class="help-block red-text">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('birthDate') ? ' invalid' : '' }} col s12">
                                <label for="birthDate" class="col-md-4 control-label">birthDate</label>

                                <div class="col-md-6">
                                    <input type="text" class="datepicker" name="birthDate" value="{{$user->birthDate}}"   id="birthDate" >

                                    @if ($errors->has('birthDate'))
                                        <span class="help-block red-text">
                                        <strong>{{ $errors->first('birthDate') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group col s12">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" name="submit">
                                        Update
                                    </button>
                                    <a href="{{route('pass',$user->id)}}" class="btn btn-primary" style="margin-top: 5px; margin-bottom: 5px">
                                        Change Password
                                    </a>
                                    <a href="{{route('profind',$user->id)}}" class="btn btn-primary" >
                                        Back
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection