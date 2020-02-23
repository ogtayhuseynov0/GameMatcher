@extends('layout.master')

@section('section')
    <div class="container">
        <div class="section">
            <div class="row">
                <div class="col s12 m6 offset-m3">
                    <div class="card">
                        <div class="card-image text-center">
                            @if($user->gender=="Female")
                              <img src="{{asset('images/lilly.jpg')}}">
                                @else
                                <img src="{{asset('images/oglan.png')}}">

                            @endif
                        </div>
                        <div class="card-content center">
                            <h5>{{$user->name}} {{$user->surname}}</h5>
                                <table class="">
                                    <tbody>
                                    <tr>
                                        <td>ID</td>
                                        <td>{{$user->id}}</td>
                                    </tr>
                                    @if($user->position !=null)
                                        <tr>
                                            <td>Position</td>
                                            <td>{{$user->position}}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>Birthday</td>
                                        <td>{{$user->birthDate}}</td>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td>{{$user->gender}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{$user->email}}</td>
                                    </tr>
                                    @if(empty($clbs))

                                        @else
                                        <tr>
                                            <td>Member of Teams</td>
                                            <td>
                                                <div class="collection">
                                                    @foreach($clbs as $clb)
                                                        <a href="{{url('club',$clb["id"])}}" class="collection-item">{{$clb->name}}</a>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>

                            </div>
                            @if($user->id == \Illuminate\Support\Facades\Auth::user()->id)
                                <div class="card-action center">

                                <a href="{{route('uedit',$user->id)}}" class="btn waves-effect waves-light gradient-45deg-blue-grey-blue">Edit</a>
                                </div>
                            @else
                            @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection