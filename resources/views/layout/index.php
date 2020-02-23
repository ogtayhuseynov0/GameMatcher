<?php
session_start();
//
//if (!isset($_SESSION["urid"])) {
//    header("location: main.php");
//}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <meta http-equiv="expires" content="30"/>
    <title>USG</title>

    <!-- CSS  -->
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/mat.min.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <!--end CSS-->
</head>
<body>
<!--begin nav-->
<div class="">
    <nav class="myColor " role="navigation">
        <div class="nav-wrapper container"><a href="#" class="brand-logo" id="mmm">USG</a>
            <ul class="right hide-on-med-and-down">
                <li><a href="#" onclick="anm(document.getElementById('ins'))">Instructors</a></li>
                <li><a href="#" onclick="anm(document.getElementById('abt'))">About</a></li>
                <?php
                if (isset($_SESSION["urid"])) {
                    if (strcmp($_SESSION["urid"], "admin@ada.edu.az") == 0) {
                        echo '<li><a href="admin.php">Admin Page</a></li>';
                    }
                    echo '<li><a href="mprof.php">My Profile</a></li>';
                    echo '<li><a href="logout.php">Logout</a></li>';
                } else {
                    echo '<li><a href="main.php">Login | Register</a></li>';
                }
                ?>
            </ul>

            <ul id="nav-mobile" class="side-nav">
                <li><a href="#" onclick="anm(document.getElementById('ins'))">Instructors</a></li>
                <li><a href="#" onclick="anm(document.getElementById('abt'))">About</a></li>
                <?php
                if (isset($_SESSION["urid"])) {
                    if (strcmp($_SESSION["urid"], "admin@ada.edu.az") == 0) {
                        echo '<li><a href="admin.php">Admin Page</a></li>';
                    }
                    echo '<li><a href="mprof.php">My Profile</a></li>';
                    echo '<li><a href="logout.php">Logout</a></li>';
                } else {
                    echo '<li><a href="main.php">Login | Register</a></li>';
                }
                ?>
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse "><i class="fa fa-bars white-text"></i></a>
        </div>
    </nav>
</div>
<!--end nav-->
<!---->
<div class="parallax-container">
    <div class="parallax"><img src="images/unnamed.jpg"></div>
</div>
<div class="section ">
    <!--instructors-->
    <div class="container">
        <div class="row">
            <div class="hr-sect" id="ins"><h4>Top Scored Instructors</h4></div>
        </div>
        <div class="row">
            <?php include "topTree.php" ?>
        </div>
        <h6 class="center">
            <a href="instructors.php" class="btn myColor sll">See All</a>
        </h6>
    </div>
    <!--instructors-->
    <div class="row container">
        <div class="hr-sect"><h4 class="header" id="abt">About</h4></div>
        <p class="grey-text text-darken-3 lighten-3">
            This page was created by ADA Undergraduate Student Government and presented to ADA students as a service for evaluation of ADA University professors. To vote and see the results you should sign in using your university mail that has 'ada.edu.az' domain. Voting, criticizing and etc. are completely anonymous.
        </p>
    </div>
</div>
<div class="parallax-container">
    <div class="parallax"><img src="images/aasa.jpeg"></div>
</div>

<!--folating action button-->
<div class="fixed-action-btn">
    <a class="btn-floating btn-large myColor" id="upBtn" onclick="anm(document.getElementById('mmm'))">
        <i class="fa fa-arrow-circle-up"></i>
    </a>
</div>

<!---->
<footer class="section" style="">
    <div class="footer-copyright">
        <div class="container">
            <span class="">2017 All Rights Reserved by USG ©</span>
            <img src="images/image001.png" class="right" style="" height="35" width="130"/>
            <img src="images/Adalogonew.png" class="right" style="padding-right: 5px" height="35" width="70"/>
        </div>
    </div>
</footer>

<!--  Scripts-->
<script src="js/jquery-2.1.1.min.js"></script>
<script src="js/materialize.min.js"></script>
<script src="js/init.js"></script>
<script>

    function anm(item) {
        $('html, body').animate({
            scrollTop: $(item).offset().top
        }, 500);
    }
</script>
</body>
</html>
