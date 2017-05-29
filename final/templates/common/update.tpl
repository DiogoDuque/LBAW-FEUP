<!DOCTYPE html>
<html lang="en">
<head>
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

    <link rel="icon" href="{$BASE_URL}resources/img/logo-64.ico">
</head>
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
                        <label for="username"><span class="glyphicon glyphicon-user"></span> Username</label>
                        <input name="username" type="text" class="form-control" id="username_signup" placeholder="Enter username" required>
                    </div>
                    <div class="form-group">
                        <label for="email"><span class="glyphicon glyphicon-envelope"></span> Email</label>
                        <input name="email" type="email" class="form-control" id="email_signup" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
                        <input name="password" type="password" class="form-control" id="psw_signup" placeholder="Enter password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_psw"><span class="glyphicon glyphicon-eye-ope"></span> Confirm Password</label>
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