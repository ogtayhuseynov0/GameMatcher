@extends('layout.master')

@section('section')
    <div class="container">
        <div class="row">
            <div class="col s12 m6 l6 offset-m3 offset-l3">
                <div class="panel panel-default login-sec" style="margin-top: 2%">
                    @if($done)
                        <div id="card-alert" class="card green">
                            <div class="card-content white-text">
                                <p>Password has been changed!</p>
                            </div>
                        </div>
                    @endif

                    @if (!empty($error[0]) )
                        @if (array_key_exists('error',$error))
                            <span class="help-block red-text">
                                        <strong>{{ $errors->first('password_confirmation') }} {{$error['error']}}</strong>
                                    </span>
                        @endif

                            @if (!empty($error[0]['password']) && array_key_exists('0',$error[0]['password']))
                                <span class="help-block red-text">
                                        <strong> {{$error[0]['password'][0]}}</strong>
                                    </span><br/>
                            @endif
                            @if (!empty($error[0]['password_confirmation']) && array_key_exists('0',$error[0]['password_confirmation']))
                                <span class="help-block red-text">
                                        <strong> {{$error[0]['password_confirmation'][0]}}</strong>
                                    </span><br/>
                            @endif

                    @endif
                    <div class="panel-title center ">
                        <h5 class="teal-text">Edit Password</h5>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{route('epass',[$user->id])}}">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}

                            <div class="form-group{{ array_key_exists('currpass',$error) ? ' invalid validate' : '' }} col s12">
                                <label for="currpass" class="col-md-4 control-label">Current Password</label>

                                <div class="col-md-6">
                                    <input id="currpass" type="password" class="form-control {{ array_key_exists('currpass',$error) ? ' invalid validate' : '' }}" name="currpass" required>

                                    @if (array_key_exists('currpass',$error))
                                        <span class="help-block red-text">
                                        <strong>{{ $errors->first('currpass') }} {{$error['currpass']}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' invalid' : '' }} col s12">
                                <label for="password" class="col-md-4 control-label">New Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                </div>
                            </div>

                            <div class="form-group col s12">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                </div>
                            </div>

                            <div class="form-group col s12">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" name="submit">
                                        Change
                                    </button>
                                    <a  href="{{route('uedit',\Illuminate\Support\Facades\Auth::user()->id)}}" class="btn btn-primary right" >
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