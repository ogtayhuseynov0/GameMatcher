<div class="navbar-fixed ">
    <nav class="nav-wrapper white" role="navigation">
        <div class=" container">
            <a id="logo-container" href="{{URL::to('/')}}" class="brand-logo teal-text">GameMatcher</a>
            <ul class="right hide-on-med-and-down">
                <li class="center {{ Request::path() == 'feed' ? 'active' : '' }}">
                    <a href="{{URL::to('feed')}}">Sport Feed</a>
                </li>
                <li class="center {{ Request::path() == 'search' ? 'active' : '' }}">
                    <a href="{{URL::to('search')}}">Search</a>
                </li>
                <li class="center {{ Request::path() == 'schedule' ? 'active' : '' }}">
                    <a href="{{URL::to('schedule')}}">Schedule</a></li>
                <li class="center dropdown-button" data-activates='dropdown1' data-constrainwidth="false">
                    <a href=""  class="teal-text">

                        {{--<img src="images/yuna.jpg" alt="Person"--}}
                             {{--class='dropdown-button circle' data-activates='dropdown1' data-constrainwidth="false"--}}
                             {{--width="50" height="50" style="margin-top: 5px">--}}
                        @guest
                            Testname
                            @else
                              {{ Auth::user()->name }}
                        @endguest

                    </a>
                </li>
            </ul>

            <!-- Dropdown Structure -->
            <ul id='dropdown1' class='dropdown-content' style="margin-top: 70px">
                <li><a href="{{route('profind',\Illuminate\Support\Facades\Auth::user()->id)}}"><i class="fa fa-user-circle material-icons" aria-hidden="true"></i>Profile</a></li>
                <li class="divider"></li>
                <li><a href="#"><i class="fa fa-gear material-icons" aria-hidden="true"></i>Settings</a></li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out material-icons" aria-hidden="true"></i> Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
            <!--            mobile navigation menu-->

            <ul id="nav-mobile" class="side-nav white ">
                <li class="center-align"><img src="{{asset('images/yuna.jpg')}}" class="responsive-img circle"/></li>
                <li class="divider"></li>
                <li><a class="subheader">Menu</a></li>
                <li><a href="{{route('profind',\Illuminate\Support\Facades\Auth::user()->id)}}"><i class="fa fa-user-circle material-icons" aria-hidden="true"></i>Profile</a></li>
                <li><a href="#"><i class="fa fa-gear material-icons" aria-hidden="true"></i>Settings</a></li>
                <li><a class="subheader">Actions</a></li>
                <li><a href="#" class="collection-item"><i class="fa fa-futbol-o fa-1x"></i> Create Match</a></li>
                <li><a href="{{url('cclub')}}" class="collection-item"><i class="fa fa-creative-commons fa-1x"></i> Create Team</a>
                </li>
                {{--<li><a class="subheader">My Teams</a></li>--}}
                {{--@foreach($arr as $ar1)--}}
                    {{--<li>  <a href="club/{{$ar1->id}}" class="collection-item"><i class="fa fa-futbol-o fa-1x"></i> {{$ar1->name}}</a></li>--}}
                {{--@endforeach--}}
            </ul>
            <!--            nav menu onz mobile-->
            <a href="" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
            <!--                                    Menu Links as buttons on mobile devices-->
            <a href="" onclick="event.preventDefault();" class="right button-collapse2 dropdown-button teal-text"
               data-activates='dropdown2' data-constrainwidth="false" style=""><i class="fa fa-chevron-circle-down material-icons"
                                                                   aria-hidden="true" ></i></a>
            <!--                    end of menu on mobile-->
            <!-- Dropdown Structure -->
            <ul id='dropdown2' class='dropdown-content' style="margin-top: 5%">
                <li><a href="{{URL::to('feed')}}" class=" teal-text">
                        <i class="fa fa-home material-icons"></i> Home</a></li>
                <li><a href="{{URL::to('search')}}" class=" teal-text">
                        <i class="fa fa-search material-icons"></i> Search</a></li>
                <li>
                <a href="{{URL::to('schedule')}}" class=" teal-text">
                        <i class="fa fa-calendar material-icons" ></i> Schedule
                    </a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out material-icons" ></i> Logout
                    </a>
                </li>

            </ul>

        </div>
    </nav>
</div>