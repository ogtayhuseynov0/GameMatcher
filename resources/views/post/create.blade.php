@extends('layout.master')

@section('section')

    <div class="container">
        <div class="row" style="margin-top: 5px">
            <div class="col s12 m6 l6 offset-m3 offset-l3">
                <div class="card darken-1">
                    <div class="card-content">
                        <span class="card-title center">Create Post</span>

                        <div class="row">
                            <form class="form-horizontal" method="POST" action="{{route('cpost',$id)}}"
                                  style="margin-top: 2%" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="club_id" value="{{$id}}">
                                <div class="form-group{{ $errors->has('text') ? ' invalid' : '' }} col s12">
                                    <label for="text" class="col-md-4 control-label">Text</label>

                                    <div class="">
                                     <textarea id="text" type="text" class="form-control materialize-textarea" name="text"
                                      required data-length="500"></textarea>

                                        @if ($errors->has('text'))
                                            <span class="help-block invalid red-text">
                                               <strong>{{ $errors->first('text') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('imagePath') ? ' invalid' : '' }} col s12"
                                     style="margin-top: 2%; margin-bottom: 2%">
                                    <label for="imagePath" class="col-md-4 control-label">Optional Image</label>

                                    <div class="">
                                        <input id="imagePath" type="file" class="form-control" name="imagePath"
                                        >

                                        @if ($errors->has('imagePath'))
                                            <span class="help-block invalid red-text">
                                        <strong>{{ $errors->first('imagePath') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group col s12" style="margin-top: 2%">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary" name="submit">
                                            Post
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
