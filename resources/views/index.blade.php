<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>GameMatcher find your opponent.</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/font-awesome.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
<div class="navbar-fixed nav-wrapper">
    <nav class="white" role="navigation">
        <div class=" container">
            <a id="logo-container" href="#" class="brand-logo teal-text">GameMatcher</a>
            <ul class="right hide-on-med-and-down">
                <li ><a href="#features" >Features</a></li>
                <li ><a href="#about" >About</a></li>
                <li ><a href="#contact" >Contact</a></li>
                @auth
                <li> <a href="{{ url('/feed') }}" class="teal-text">Home</a></li>
                @else
                    <li><a href="{{url('/login')}}" class="waves-effect waves-light btn">Sign In</a></li>
                @endauth

            </ul>

            <ul id="nav-mobile" class="side-nav white">
                <li><a class="subheader">Menu</a></li>
                <li ><a href="#features" >Features</a></li>
                <li ><a href="#about" >About</a></li>
                <li ><a href="#contact" >Contact</a></li>
                @auth
                <li> <a href="{{ url('/feed') }}" class="teal-text">Home</a></li>
                @else
                    <li><a href="{{url('/login')}}" class="waves-effect waves-light btn">Sign In</a></li>
                @endauth
            </ul>

            <a href="" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
            @auth
            <a href="{{URL::to('feed')}}" class="button-collapse2 teal-text right">
                    <i class="fa fa-home material-icons"></i></a>
            @else
                <a href="login"  class="right button-collapse2 teal-text"
                ><i class="fa fa-sign-in material-icons" aria-hidden="true" ></i></a>
            @endauth
        </div>
    </nav>
</div>
<div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
        <div class="container">
            <br><br>
            <div style="background-color: rgba(0,0,0,0.6)">
                <h1 class="header center teal-text text-lighten-2">GameMatcher</h1>
                <div class="row center" >
                    <h5 class="header col s12 light">It's never been this easy to find opponent</h5>
                </div>
            </div>
            <div class="row center">
                @auth

                @else
                    <a href="{{url('/register')}}" id="download-button"
                       class="btn-large waves-effect waves-light teal lighten-1">Sign Up</a>
                    @endauth
            </div>
            <br><br>

        </div>
    </div>
    <div class="parallax"><img src="images/background2.jpg" alt="Unsplashed background img 1" ></div>
</div>


<div class="container" id="features">
    <div class="section" >
        <!--   Icon Section   -->
        <div class="row" >
            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center  teal-text"><i class="fa fa-users material-icons" aria-hidden="true"></i></h2>
                    <h5 class="center">Create your Team</h5>

                    <p class="light">This site will allow you to create your own team or club. You will decide
                    who will be member of your team/club. As a club you can share your sport activities with your
                    fans and followers.</p>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center teal-text"><i class="material-icons">group</i></h2>
                    <h5 class="center">Find Opponents</h5>

                    <p class="light">GameMatcher will help you to find opponent teams with the same
                    taste of sport and geographical location with you.</p>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center teal-text"><i class="fa fa-soccer-ball-o material-icons" aria-hidden="true"></i></h2>
                    <h5 class="center">Choose Sport Type</h5>

                    <p class="light">Website`s functionality is not limited with just Football, you
                        can choose any kind of sport to create your own sport club and find opponents
                        near to you for playing and have a fun.</p>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
        <div class="container">
            <div class="row center">
<!--                <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>-->
            </div>
        </div>
    </div>
    <div class="parallax"><img src="images/background1.jpg" alt="Unsplashed background img 2"></div>
</div>

<div class="container" id="about">
    <div class="section">

        <div class="row">
            <div class="col s12 center">
                <h3><i class="mdi-content-send brown-text"></i></h3>
                <h4>About Us</h4>
                <p class="left-align light">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Maecenas eros justo, ullamcorper a sapien id, viverra ultrices eros. Morbi sem neque, posuere et pretium eget, bibendum sollicitudin lacus. Aliquam eleifend sollicitudin diam, eu mattis nisl maximus sed. Nulla imperdiet semper molestie. Morbi massa odio, condimentum sed ipsum ac, gravida ultrices erat. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>
            </div>
        </div>

    </div>
</div>


<div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
        <div class="container">
            <div class="row center">
<!--                <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>-->
            </div>
        </div>
    </div>
    <div class="parallax"><img src="images/background3.jpg" alt="Unsplashed background img 3"></div>
</div>

<footer class="page-footer white" id="contact">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h4 class="center teal-text">Contact Us</h4>
                <form method="POST" action="/">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="input-field col s12 white-text">
                            <input id="email" type="email" name="email" class="validate teal-text" required>
                            <label for="email">Email</label>
                            @if ($errors->has('email'))
                                <span class="help-block invalid red-text">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group{{ $errors->has('text') ? ' invalid' : '' }} col s12">
                            <label for="textarea1" class="control-label">Text</label>

                            <div class="input-field">
                                     <textarea id="textarea1" type="text" class="form-control materialize-textarea teal-text" name="text"
                                               required data-length="1000"></textarea>

                                @if ($errors->has('text'))
                                    <span class="help-block invalid red-text">
                                               <strong>{{ $errors->first('text') }}</strong>
                                            </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <button type="submit" class="waves-button-input waves-effect waves-light btn " name="send">Send</button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="col l3 s12">

            </div>
        </div>
    </div>
    <div class="footer-copyright center teal">
        <div class="container">
            Made by <a class="brown-text text-lighten-3" href="">ThatFuture</a>
        </div>
    </div>
</footer>

<!--  Scripts-->
<script src="js/jquery-2.1.1.js"></script>
<script src="js/materialize.js"></script>
<script src="js/init.js"></script>
<script>
    $('textarea#textarea1').characterCounter();
</script>
</body>
</html>
