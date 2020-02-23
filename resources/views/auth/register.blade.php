@extends('layout.masterlogin')

@section('section')
<div class="container">
    <div class="row">
        <div class="col s12 m6 l6 offset-m3 offset-l3">
            <div class="panel panel-default login-sec">

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' invalid' : '' }} col s12 m6 l6">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" required autofocus>

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
                                <input id="surname" type="text" class="form-control" name="surname" required autofocus>

                                @if ($errors->has('surname'))
                                    <span class="help-block red-text">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' invalid' : '' }} col s12">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required>

                                @if ($errors->has('email'))
                                    <span class="help-block red-text">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('gender') ? ' invalid' : '' }} col s12">
                            <label for="gender" class="col-md-4 control-label">Gender</label>

                            <div class="col-md-6">
                                <select name="gender" required id="gender">
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
                                <input type="text" class="datepicker" name="birthDate"  id="birthDate" required>

                                @if ($errors->has('birthDate'))
                                    <span class="help-block red-text">
                                        <strong>{{ $errors->first('birthDate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' invalid' : '' }} col s12">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block red-text">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
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
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
