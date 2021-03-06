<!DOCTYPE html>
<html lang="en">
<head>
    <title>HoWhy</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:url"           content="{$BASE_URL}" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="HoWhy" />
    <meta property="og:description"   content="The best place to ask your questions!" />
    <meta property="og:image"         content="{$BASE_URL}resources/img/howhy-logo-with-text.svg" />

    <link rel="stylesheet" type="text/css" href= "{$BASE_URL}vendors/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href= "{$BASE_URL}lib/css/main.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <link rel="icon" href="{$BASE_URL}resources/img/logo-64.ico">
</head>
<body>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="logo pull-left navbar-header" href="{$BASE_URL}pages/home.php"><img src="{$BASE_URL}resources/img/howhy-logo-with-text.svg" height="30" alt="Homepage"></a>

        </div>

        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Categories <span
                            class="caret"></span></a>
                    <ul class="dropdown-menu">
                        {foreach $categories as $category}
                            <li><a href="{$BASE_URL}pages/home.php?category={$category.id}">{$category.name}</a></li>
                        {/foreach}
                    </ul>
                </li>

                {if $PERMISSIONS=="Administrator" || $PERMISSIONS=="Moderator"}

                    <li><a href="{$BASE_URL}pages/admin/reports.php">Control Panel</a></li>

                {/if}


            </ul>

            <form action="{$BASE_URL}pages/posts/search.php#results" class="navbar-form navbar-right" role="search">
                <div class="form-group input-group">
                    <input type="text" class="form-control" placeholder="Search.." name="query">

                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Advanced search">
                            <span class="glyphicon glyphicon-search search-icon"></span>
                        </button>


                    </span>
                </div>
            </form>

            {if (!isset($USERNAME))}
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" data-toggle="modal" data-target="#signUp-modal"><span
                            class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#login-modal"><span
                            class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul>
            {else}
                <ul class="nav navbar-nav navbar-right">
                    <li><button type="button" class="btn btn-primary vertical-align" onclick="location.href='{$BASE_URL}pages/posts/question_add.php';">Ask a question</button></li>
                    <li><a href="{$BASE_URL}pages/profile/view_profile.php"><span class="glyphicon glyphicon-user"></span> Hello, {$USERNAME} </a></li>
                    <li><a href="{$BASE_URL}actions/auth/logout.php" data-toggle="modal"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
            {/if}


        </div>

    </div>
</nav>

<div class="modal fade" id="login-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
            </div>

            <div class="modal-body">
                <form action="{$BASE_URL}actions/auth/login.php" method="post">
                    <div class="form-group">
                        <label for="username"><span class="glyphicon glyphicon-user"></span> Username</label>
                        <input name="username" type="text" class="form-control" id="username" placeholder="Enter Username" required>
                    </div>
                    <div class="form-group">
                        <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                        <input name="password" type="password" class="form-control" id="psw" placeholder="Enter password" required>
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

<div class="modal fade" id="signUp-modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><span class="glyphicon glyphicon-lock"></span>Sign Up</h4>
            </div>

            <div class="modal-body">
                <form action="{$BASE_URL}actions/auth/signup.php" method="post">
                    <input type='hidden' name='posted' value='true'>

                    <div class="form-group">
                        <label for="username_signup"><span class="glyphicon glyphicon-user"></span> Username</label>
                        <input name="username" type="text" class="form-control" id="username_signup" placeholder="Enter username" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="email_signup"><span class="glyphicon glyphicon-envelope"></span> Email</label>
                        <input name="email" type="email" class="form-control" id="email_signup" placeholder="Enter email" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="psw_signup"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                        <input name="password" type="password" class="form-control" id="psw_signup" placeholder="Enter password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_psw_signup"><span class="glyphicon glyphicon-eye-ope"></span> Confirm Password</label>
                        <input name="confirm_password" type="password" class="form-control" id="confirm_psw_signup" placeholder="Reenter password" required><span id='message'></span>
                    </div>
                    <button type="submit" class="btn btn-success btn-block" id="button_signup"><span
                            class="glyphicon glyphicon-registration-mark"></span> Sign Up
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{$BASE_URL}lib/js/signup_modal.js"></script>

<script>

    function showErrorMessage(message){
        $('#message').html(message).css('color', 'red');
            $('#button_signup').prop('disabled', true);
    }

    function validate(){
        var pattern = /[^\w\d]+/;

        var username = $('#username_signup').val();
        if(username.length<4 || username.length>20){
            showErrorMessage("Username must have between 4 and 20 characters.");
            return;
        }

        var usernameHasSymbols = pattern.test(username);
        if(usernameHasSymbols){
            showErrorMessage("Username can only contain characters and numbers.");
            return;
        }

        var email = $('#email_signup').val();
        var emailIsCorrect = /[\w\d]+@[\w\d]+/.test(email);
        console.log(emailIsCorrect);
        if(!emailIsCorrect){
            showErrorMessage("Email does not appear to be correct.");
            return;
        }

        var password = $('#psw_signup').val();
        if(password.length<4 || password.length>20){
            showErrorMessage("Password must have between 4 and 20 characters.");
            return;
        }

        var passwordHasSymbols = pattern.test(password);
        if(passwordHasSymbols){
            showErrorMessage("Password can only contain characters and numbers.");
            return;
        }

        var passwordConf = $('#confirm_psw_signup').val();
        if(password != passwordConf){
            showErrorMessage("Password is not matching.");
            return;
        }

        $('#message').html('');
        $('#button_signup').prop('disabled', false);
    }

    $('#button_signup').prop('disabled', true);

    $('#username_signup, #email_signup, #psw_signup, #confirm_psw_signup').on('keyup', function () {
        validate();
    });

</script>
