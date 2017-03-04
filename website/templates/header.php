<?php
    $logged_in = false
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>HoWhy</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../vendors/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../lib/css/main.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="icon" href="../resources/img/logo-64.ico">
</head>
<body>

<!--Big thing at the top-->
<div class="jumbotron text-center">
    <h1 class="logo"><a class ="noStyle" href="../views/home.php">HoWhy</a></h1>
    <a class ="noStyle" href="../views/home.php"><img src="../resources/img/logo-vectors-original.svg" class="svg-logo logo"></a>
    <p>Where questions become answers!</p>
</div>

<!--NavBar-->
<nav class="navbar navbar-inverse">
    <div class="container-fluid">

        <!--Title/Logo and collaped simbol-->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!--<a class="navbar-brand" href="#">Logo</a>-->
            <!-- Logo-->
            <a class="navbar-brand" href="../views/home.php"><img src="../resources/img/logo-vectors-inverted.svg"
                                                                  height="40" width="40"></a>
        </div>

        <div class="collapse navbar-collapse" id="myNavbar">
            <!--Categories, Admin Things and the Rest (at the left side)-->
            <ul class="nav navbar-nav">

                <!--Categories-->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Categories <span
                            class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Foods and Drinks</a></li>
                        <li><a href="#">Sports</a></li>
                        <li><a href="#">Computers</a></li>
                        <li><a href="#">Art</a></li>
                    </ul>
                </li>

                <?php if($logged_in) { ?>

                    <!--Admin Page(more content)-->
                    <li><a href="#">Admin Page</a></li>

                <?php } ?>

            </ul>

            <!--Search Form (at the left side)-->
            <form class="navbar-form navbar-right" role="search">
                <div class="form-group input-group">
                    <input type="text" class="form-control" placeholder="Search..">
                    <span class="input-group-btn">

                        <button class="btn btn-default" type="button">
                            <a href="../views/search.php">
                                <span class="glyphicon glyphicon-search"></span>
                            </a>
                        </button>

                    </span>
                </div>
            </form>

            <?php if(!$logged_in) { ?>
            <!--Login (at the right side)-->
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#" data-toggle="modal" data-target="#signUp-modal"><span
                        class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="#" data-toggle="modal" data-target="#login-modal"><span
                        class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
            <?php }

            else { ?>

            <ul class="nav navbar-nav navbar-right">
                <li><button type="button" class="btn btn-primary vertical-align"><a class ="noStyle" href="../views/newQuestion.php">Ask a question</a></button></li>
                <li><a href="#"><span class="glyphicon glyphicon-user"></span> Hello, Peralta </a></li>
                <li><a href="#" data-toggle="modal"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>

            <?php } ?>



        </div>

    </div>
</nav>

<!--Login Modal-->
<div class="modal fade" id="login-modal" role="dialog">
    <div class="modal-dialog">
        <!--Content here-->
        <div class="modal-content">
            <!-- The Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
            </div>

            <!-- Body(form)-->
            <div class="modal-body">
                <form role="form">
                    <div class="form-group">
                        <label for="username"><span class="glyphicon glyphicon-user"></span> Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                        <input type="text" class="form-control" id="psw" placeholder="Enter password">
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" value="" checked>Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-success btn-block"><span
                            class="glyphicon glyphicon-off"></span> Login
                    </button>
                </form>
            </div>
            <div class="modal-footer">
                <p>Not a member? <a href="#">Sign Up</a></p>
                <p>Forgot <a href="#">Password?</a></p>
            </div>

        </div>
    </div>
</div>

<!--SignUp Modal-->
<div class="modal fade" id="signUp-modal" role="dialog">
    <div class="modal-dialog">
        <!--Content here-->
        <div class="modal-content">
            <!-- The Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><span class="glyphicon glyphicon-lock"></span> Sign Up</h4>
            </div>

            <!-- Body(form)-->
            <div class="modal-body">
                <form role="form">
                    <div class="form-group">
                        <label for="username"><span class="glyphicon glyphicon-user"></span> Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Enter username">
                    </div>
                    <div class="form-group">
                        <label for="email"><span class="glyphicon glyphicon-envelope"></span> Email</label>
                        <input type="text" class="form-control" id="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                        <input type="text" class="form-control" id="psw" placeholder="Enter password">
                    </div>
                    <button type="submit" class="btn btn-success btn-block"><span
                            class="glyphicon glyphicon-registration-mark"></span> Sign Up
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

