@extends('layout.master')

@section('section')
    <div class="container">
        <div class="row">
            <div class="col s12 m6 l6 offset-m3 offset-l3">
                <div class="panel panel-default cclub" style="margin-top: 20px">

                    <div class="panel-body">
                        <div class="text-success"></div>
                        <form class="form-horizontal" method="POST" action="{{ route('cclub') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                            <div class="form-group{{ $errors->has('name') ? ' invalid' : '' }} col s12">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="">
                                    <input id="name" type="text" class="form-control" name="name" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block invalid red-text">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
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