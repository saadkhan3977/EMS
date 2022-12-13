{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- Styles -->
        <style>
        html, body {
        background-color:  #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
        }
        .full-height {
        height: 100vh;
        }
        .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
        }
        .position-ref {
        position: relative;
        }
        .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
        }
        .content {
        text-align: center;
        }
        .title {
        font-size: 84px;
        }
        .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
        }
        .m-b-md {
        margin-bottom: 30px;
        }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
            <div class="top-right links">
                @auth
                <a href="{{ url('/home') }}">Home</a>
                @else
                <a href="{{ route('login') }}">Login</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
                @endif
                @endauth
            </div>
            @endif
            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>
                <div class="links">
                    <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>
    </body>
</html>
--}}
{{-- <!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Theme Made By www.w3schools.com -->
        <title>Bootstrap Theme Company Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <style>
        body {
        font: 400 15px Lato, sans-serif;
        line-height: 1.8;
        color: #818181;
        }
        h2 {
        font-size: 24px;
        text-transform: uppercase;
        color: #303030;
        font-weight: 600;
        margin-bottom: 30px;
        }
        h4 {
        font-size: 19px;
        line-height: 1.375em;
        color: #303030;
        font-weight: 400;
        margin-bottom: 30px;
        }
        .jumbotron {
        background-color: #367fa9;
        color: #fff;
        padding: 100px 25px;
        font-family: Montserrat, sans-serif;
        }
        .container-fluid {
        padding: 60px 50px;
        }
        .bg-grey {
        background-color:  #f6f6f6;
        }
        .logo-small {
        color: #367fa9;
        font-size: 50px;
        }
        .logo {
        color: #367fa9;
        font-size: 200px;
        }
        .thumbnail {
        padding: 0 0 15px 0;
        border: none;
        border-radius: 0;
        }
        .thumbnail img {
        width: 100%;
        height: 100%;
        margin-bottom: 10px;
        }
        .carousel-control.right, .carousel-control.left {
        background-image: none;
        color: #367fa9;
        }
        .carousel-indicators li {
        border-color: #367fa9;
        }
        .carousel-indicators li.active {
        background-color:  #367fa9;
        }
        .item h4 {
        font-size: 19px;
        line-height: 1.375em;
        font-weight: 400;
        font-style: italic;
        margin: 70px 0;
        }
        .item span {
        font-style: normal;
        }
        .panel {
        border: 1px solid #367fa9;
        border-radius:0 !important;
        transition: box-shadow 0.5s;
        }
        .panel:hover {
        box-shadow: 5px 0px 40px rgba(0,0,0, .2);
        }
        .panel-footer .btn:hover {
        border: 1px solid #367fa9;
        background-color:  #fff !important;
        color: #367fa9;
        }
        .panel-heading {
        color: #fff !important;
        background-color:  #367fa9 !important;
        padding: 25px;
        border-bottom: 1px solid transparent;
        border-top-left-radius: 0px;
        border-top-right-radius: 0px;
        border-bottom-left-radius: 0px;
        border-bottom-right-radius: 0px;
        }
        .panel-footer {
        background-color:  white !important;
        }
        .panel-footer h3 {
        font-size: 32px;
        }
        .panel-footer h4 {
        color: #aaa;
        font-size: 14px;
        }
        .panel-footer .btn {
        margin: 15px 0;
        background-color:  #367fa9;
        color: #fff;
        }
        .navbar {
        margin-bottom: 0;
        background-color:  #367fa9;
        z-index: 9999;
        border: 0;
        font-size: 12px !important;
        line-height: 1.42857143 !important;
        letter-spacing: 4px;
        border-radius: 0;
        font-family: Montserrat, sans-serif;
        }
        .navbar li a, .navbar .navbar-brand {
        color: #fff !important;
        }
        .navbar-nav li a:hover, .navbar-nav li.active a {
        color: #367fa9 !important;
        background-color:  #fff !important;
        }
        .navbar-default .navbar-toggle {
        border-color: transparent;
        color: #fff !important;
        }
        footer .glyphicon {
        font-size: 20px;
        margin-bottom: 20px;
        color: #367fa9;
        }
        .slideanim {visibility:hidden;}
        .slide {
        animation-name: slide;
        -webkit-animation-name: slide;
        animation-duration: 1s;
        -webkit-animation-duration: 1s;
        visibility: visible;
        }
        @keyframes slide {
        0% {
        opacity: 0;
        transform: translateY(70%);
        }
        100% {
        opacity: 1;
        transform: translateY(0%);
        }
        }
        @-webkit-keyframes slide {
        0% {
        opacity: 0;
        -webkit-transform: translateY(70%);
        }
        100% {
        opacity: 1;
        -webkit-transform: translateY(0%);
        }
        }
        @media screen and (max-width: 768px) {
        .col-sm-4 {
        text-align: center;
        margin: 25px 0;
        }
        .btn-lg {
        width: 100%;
        margin-bottom: 35px;
        }
        }
        @media screen and (max-width: 480px) {
        .logo {
        font-size: 150px;
        }
        }
        </style>
    </head>
    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#myPage">Logo</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#about">ABOUT</a></li>
                        <li><a href="#services">SERVICES</a></li>
                        <li><a href="#portfolio">PORTFOLIO</a></li>
                        <li><a href="#pricing">PRICING</a></li>
                        <li><a href="#contact">CONTACT</a></li>
                        @if (Route::has('login'))
                        @auth
                        <li>
                            <a href="{{ url('/home') }}">Home</a>
                        </li>
                        @else
                        <li>
                            <a href="{{ route('login') }}">Login</a>
                        </li>
                        @if (Route::has('register'))
                        <li>
                            <a href="{{ route('register') }}">Register</a>
                        </li>
                        @endif
                        @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div class="jumbotron text-center">
            <h1>Employee Management System</h1>
            <p>We specialize in Deigital Marketing</p>
        </div>
        <!-- Container (About Section) -->
        <div id="about" class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <h2>About Company Page</h2><br>
                    <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h4><br>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <br><button class="btn btn-default btn-lg">Get in Touch</button>
                </div>
                <div class="col-sm-4">
                    <span class="glyphicon glyphicon-signal logo"></span>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-grey">
            <div class="row">
                <div class="col-sm-4">
                    <span class="glyphicon glyphicon-globe logo slideanim"></span>
                </div>
                <div class="col-sm-8">
                    <h2>Our Values</h2><br>
                    <h4><strong>MISSION:</strong> Our mission lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</h4><br>
                    <p><strong>VISION:</strong> Our vision Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
            </div>
        </div>
        <!-- Container (Services Section) -->
        <div id="services" class="container-fluid text-center">
            <h2>SERVICES</h2>
            <h4>What we offer</h4>
            <br>
            <div class="row slideanim">
                <div class="col-sm-4">
                    <span class="glyphicon glyphicon-off logo-small"></span>
                    <h4>POWER</h4>
                    <p>Lorem ipsum dolor sit amet..</p>
                </div>
                <div class="col-sm-4">
                    <span class="glyphicon glyphicon-heart logo-small"></span>
                    <h4>LOVE</h4>
                    <p>Lorem ipsum dolor sit amet..</p>
                </div>
                <div class="col-sm-4">
                    <span class="glyphicon glyphicon-lock logo-small"></span>
                    <h4>JOB DONE</h4>
                    <p>Lorem ipsum dolor sit amet..</p>
                </div>
            </div>
            <br><br>
            <div class="row slideanim">
                <div class="col-sm-4">
                    <span class="glyphicon glyphicon-leaf logo-small"></span>
                    <h4>GREEN</h4>
                    <p>Lorem ipsum dolor sit amet..</p>
                </div>
                <div class="col-sm-4">
                    <span class="glyphicon glyphicon-certificate logo-small"></span>
                    <h4>CERTIFIED</h4>
                    <p>Lorem ipsum dolor sit amet..</p>
                </div>
                <div class="col-sm-4">
                    <span class="glyphicon glyphicon-wrench logo-small"></span>
                    <h4 style="color:#303030;">HARD WORK</h4>
                    <p>Lorem ipsum dolor sit amet..</p>
                </div>
            </div>
        </div>
        <!-- Container (Portfolio Section) -->
        <div id="portfolio" class="container-fluid text-center bg-grey">
            <h2>Portfolio</h2><br>
            <h4>What we have created</h4>
            <div class="row text-center slideanim">
                <div class="col-sm-4">
                    <div class="thumbnail">
                        <img src="/assets/admin/dist/img/photo1.png" alt="Paris" width="400" height="300">
                        <p><strong>Paris</strong></p>
                        <p>Yes, we built Paris</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="thumbnail">
                        <img src="/assets/admin/dist/img/photo2.png" alt="New York" width="400" height="300">
                        <p><strong>New York</strong></p>
                        <p>We built New York</p>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="thumbnail">
                        <img src="/assets/admin/dist/img/photo4.jpg" alt="San Francisco" width="400" height="300">
                        <p><strong>San Francisco</strong></p>
                        <p>Yes, San Fran is ours</p>
                    </div>
                </div>
            </div><br>
            
            <h2>What our customers say</h2>
            <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <h4>"This company is the best. I am so happy with the result!"<br><span>Michael Roe, Vice President, Comment Box</span></h4>
                    </div>
                    <div class="item">
                        <h4>"One word... WOW!!"<br><span>John Doe, Salesman, Rep Inc</span></h4>
                    </div>
                    <div class="item">
                        <h4>"Could I... BE any more happy with this company?"<br><span>Chandler Bing, Actor, FriendsAlot</span></h4>
                    </div>
                </div>
                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <!-- Container (Pricing Section) -->
        <div id="pricing" class="container-fluid">
            <div class="text-center">
                <h2>Pricing</h2>
                <h4>Choose a payment plan that works for you</h4>
            </div>
            <div class="row slideanim">
                <div class="col-sm-4 col-xs-12">
                    <div class="panel panel-default text-center">
                        <div class="panel-heading">
                            <h1>Basic</h1>
                        </div>
                        <div class="panel-body">
                            <p><strong>20</strong> Lorem</p>
                            <p><strong>15</strong> Ipsum</p>
                            <p><strong>5</strong> Dolor</p>
                            <p><strong>2</strong> Sit</p>
                            <p><strong>Endless</strong> Amet</p>
                        </div>
                        <div class="panel-footer">
                            <h3>$19</h3>
                            <h4>per month</h4>
                            <button class="btn btn-lg">Sign Up</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <div class="panel panel-default text-center">
                        <div class="panel-heading">
                            <h1>Pro</h1>
                        </div>
                        <div class="panel-body">
                            <p><strong>50</strong> Lorem</p>
                            <p><strong>25</strong> Ipsum</p>
                            <p><strong>10</strong> Dolor</p>
                            <p><strong>5</strong> Sit</p>
                            <p><strong>Endless</strong> Amet</p>
                        </div>
                        <div class="panel-footer">
                            <h3>$29</h3>
                            <h4>per month</h4>
                            <button class="btn btn-lg">Sign Up</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <div class="panel panel-default text-center">
                        <div class="panel-heading">
                            <h1>Premium</h1>
                        </div>
                        <div class="panel-body">
                            <p><strong>100</strong> Lorem</p>
                            <p><strong>50</strong> Ipsum</p>
                            <p><strong>25</strong> Dolor</p>
                            <p><strong>10</strong> Sit</p>
                            <p><strong>Endless</strong> Amet</p>
                        </div>
                        <div class="panel-footer">
                            <h3>$49</h3>
                            <h4>per month</h4>
                            <button class="btn btn-lg">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container (Contact Section) -->
        <div id="contact" class="container-fluid bg-grey">
            <h2 class="text-center">CONTACT</h2>
            <div class="row">
                <div class="col-sm-5">
                    <p>Contact us and we'll get back to you within 24 hours.</p>
                    <p><span class="glyphicon glyphicon-map-marker"></span> Chicago, US</p>
                    <p><span class="glyphicon glyphicon-phone"></span> +00 1515151515</p>
                    <p><span class="glyphicon glyphicon-envelope"></span> myemail@something.com</p>
                </div>
                <div class="col-sm-7 slideanim">
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
                        </div>
                        <div class="col-sm-6 form-group">
                            <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
                        </div>
                    </div>
                    <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea><br>
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <button class="btn btn-default pull-right" type="submit">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Image of location/map -->
        <img src="/assets/admin/dist/img/photo4.jpg" class="w3-image w3-greyscale-min" style="width:100%">
        <footer class="container-fluid text-center">
            <a href="#myPage" title="To Top">
                <span class="glyphicon glyphicon-chevron-up"></span>
            </a>
            <p>Bootstrap Theme Made By <a href="https://www.w3schools.com" title="Visit w3schools">www.w3schools.com</a></p>
        </footer>
        <script>
        $(document).ready(function(){
        // Add smooth scrolling to all links in navbar + footer link
        $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
        // Prevent default anchor click behavior
        event.preventDefault();
        // Store hash
        var hash = this.hash;
        // Using jQuery's animate() method to add smooth page scroll
        // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
        $('html, body').animate({
        scrollTop: $(hash).offset().top
        }, 900, function(){
        
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
        });
        } // End if
        });
        
        $(window).scroll(function() {
        $(".slideanim").each(function(){
        var pos = $(this).offset().top;
        var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
        $(this).addClass("slide");
        }
        });
        });
        })
        </script>
    </body>
</html> --}}


<!DOCTYPE HTML>
<!--
    Big Picture by HTML5 UP
    html5up.net | @ajlkn
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
    <head>
        <title>Digitalopment</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="/home_assets/assets/css/main.css" />
        <noscript><link rel="stylesheet" href="/home_assets/assets/css/noscript.css" /></noscript>
    </head>
    <body class="is-preload">

        <!-- Header -->
            <header id="header">
                <!--<h1>Big Picture</h1>-->
                <img src="/assets/admin/dist/img/digitalopment_logo.png" alt="digitalopment" style="width:20%; padding-left:10px;">
                <nav>
                    <ul>
                        <li><a href="#intro">Intro</a></li>
                        <li><a href="#one">What I Do</a></li>
                        <li><a href="#two">Who I Am</a></li>
                        <li><a href="#work">My Work</a></li>
                        <li><a href="#contact">Contact</a></li>
                        @if (Route::has('login'))
                        @auth
                            @if(Auth::user()->admin == 1)
                                <li>
                                    <a href="{{ url('/admin/dashboard') }}">Admin Dashboard</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ url('/user_dashboard') }}">User Dashboard</a>
                                </li>
                            @endif
                        @else
                        <li>
                            <a href="{{ route('login') }}">Login</a>
                        </li>
                        @if (Route::has('register'))
                        <!--<li>-->
                        <!--    <a href="{{ route('register') }}">Register</a>-->
                        <!--</li>-->
                        @endif
                        @endauth
                        @endif
                    </ul>
                </nav>
            </header>

        <!-- Intro -->
            <section id="intro" class="main style1 dark fullscreen">
                <div class="content">
                    <header>
                        <h2>Hey.</h2>
                    </header>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    <footer>
                        <a href="#one" class="button style2 down">More</a>
                    </footer>
                </div>
            </section>

        <!-- One -->
            <section id="one" class="main style2 right dark fullscreen">
                <div class="content box style2">
                    <header>
                        <h2>What I Do</h2>
                    </header>
                    <p>Lorem ipsum dolor sit amet et sapien sed elementum egestas dolore condimentum.
                    Fusce blandit ultrices sapien, in accumsan orci rhoncus eu. Sed sodales venenatis arcu,
                    id varius justo euismod in. Curabitur egestas consectetur magna.</p>
                </div>
                <a href="#two" class="button style2 down anchored">Next</a>
            </section>

        <!-- Two -->
            <section id="two" class="main style2 left dark fullscreen">
                <div class="content box style2">
                    <header>
                        <h2>Who I Am</h2>
                    </header>
                    <p>Lorem ipsum dolor sit amet et sapien sed elementum egestas dolore condimentum.
                    Fusce blandit ultrices sapien, in accumsan orci rhoncus eu. Sed sodales venenatis arcu,
                    id varius justo euismod in. Curabitur egestas consectetur magna.</p>
                </div>
                <a href="#work" class="button style2 down anchored">Next</a>
            </section>

        <!-- Work -->
            <section id="work" class="main style3 primary">
                <div class="content">
                    <header>
                        <h2>My Work</h2>
                        <p>Lorem ipsum dolor sit amet et sapien sed elementum egestas dolore condimentum.
                        Fusce blandit ultrices sapien, in accumsan orci rhoncus eu. Sed sodales venenatis
                        arcu, id varius justo euismod in. Curabitur egestas consectetur magna vitae.</p>
                    </header>

                    <!-- Gallery  -->
                        <div class="gallery">
                            <article class="from-left">
                                <a href="/home_assets/images/maxresdefault.jpg" class="image fit"><img src="/home_assets/images/maxresdefault.jpg" title="The Anonymous Red" alt="" /></a>
                            </article>
                            <article class="from-right">
                                <a href="/home_assets/images/788fu.jpg" class="image fit"><img src="/home_assets/images/788fu.jpg" title="Airchitecture II" alt="" /></a>
                            </article>
                            <article class="from-left">
                                <a href="/home_assets/images/k7ey783.jpg" class="image fit"><img src="/home_assets/images/k7ey783.jpg" title="Air Lounge" alt="" /></a>
                            </article>
                            <article class="from-right">
                                <a href="/home_assets/images/3322.jpg" class="image fit"><img src="/home_assets/images/3322.jpg" title="Carry on" alt="" /></a>
                            </article>
                            <article class="from-left">
                                <a href="/home_assets/images/k7ey783.jpg" class="image fit"><img src="/home_assets/images/k7ey783.jpg" title="The sparkling shell" alt="" /></a>
                            </article>
                            <article class="from-right">
                                <a href="/home_assets/images/788fu.jpg" class="image fit"><img src="/home_assets/images/788fu.jpg" title="Bent IX" alt="" /></a>
                            </article>
                        </div>

                </div>
            </section>

        <!-- Contact -->
            <section id="contact" class="main style3 secondary">
                <div class="content">
                    <header>
                        <h2>Say Hello.</h2>
                        <p>Lorem ipsum dolor sit amet et sapien sed elementum egestas dolore condimentum.</p>
                    </header>
                    <div class="box">
                        <form method="post" action="#">
                            <div class="fields">
                                <div class="field half"><input type="text" name="name" placeholder="Name" /></div>
                                <div class="field half"><input type="email" name="email" placeholder="Email" /></div>
                                <div class="field"><textarea name="message" placeholder="Message" rows="6"></textarea></div>
                            </div>
                            <ul class="actions special">
                                <li><input type="submit" value="Send Message" /></li>
                            </ul>
                        </form>
                    </div>
                </div>
            </section>

        <!-- Footer -->
            <footer id="footer">

                <!-- Icons -->
                    <ul class="icons">
                        <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
                        <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
                        <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
                        <li><a href="#" class="icon brands fa-linkedin-in"><span class="label">LinkedIn</span></a></li>
                        <li><a href="#" class="icon brands fa-dribbble"><span class="label">Dribbble</span></a></li>
                        <li><a href="#" class="icon brands fa-pinterest"><span class="label">Pinterest</span></a></li>
                    </ul>

                <!-- Menu -->
                    <ul class="menu">
                        <li>&copy; Untitled</li><li>Design: <a href="https://html5up.net">HTML5 UP</a></li>
                    </ul>

            </footer>

        <!-- Scripts -->
            <script src="/home_assets/assets/js/jquery.min.js"></script>
            <script src="/home_assets/assets/js/jquery.poptrox.min.js"></script>
            <script src="/home_assets/assets/js/jquery.scrolly.min.js"></script>
            <script src="/home_assets/assets/js/jquery.scrollex.min.js"></script>
            <script src="/home_assets/assets/js/browser.min.js"></script>
            <script src="/home_assets/assets/js/breakpoints.min.js"></script>
            <script src="/home_assets/assets/js/util.js"></script>
            <script src="/home_assets/assets/js/main.js"></script>

    </body>
</html>