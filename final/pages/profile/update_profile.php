<?php

include_once("../../config/init.php");
include_once ($BASE_DIR."database/members.php");

$smarty->display("common/header.tpl");
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:url"           content="<?=$BASE_URL?>" />


    <link rel="stylesheet" type="text/css" href= "<?=$BASE_URL?>vendors/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href= "<?=$BASE_URL?>lib/css/main.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>


</head>
<div class="row">
    <div class="col-lg-6 col-offset-6 centered">
    <form class="form-horizontal" action="../../actions/member/update_profile_action.php" method="post">
    <fieldset>
        <div class="title">
            <h1 class="">Edit Profile</h1>
        </div>
        <div class="control-group">
            <label class="control-label"  for="username">Username</label>
            <div class="controls">
                <input type="text" id="usernameInfo" name="username" placeholder="" class="input-xlarge">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="email">E-mail</label>
            <div class="controls">
                <input type="email" id="emailInfo" name="email" placeholder="" class="input-xlarge">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="password">Password</label>
            <div class="controls">
                <input type="password" id="passwordInfo" name="password" placeholder="" class="input-xlarge">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="password">Password</label>
            <div class="controls">
                <input type="password" id="confirmPasswordInfo" name="confirmPassword" placeholder="" class="input-xlarge">
            </div>
        </div>

        <span id='infoMessage'></span>
        <div class="control-group">
            <div class="controls">
                <button id="button_edit" class="btn btn-success">Save Changes</button>
            </div>
        </div>
    </fieldset>
</form>
    </div>
</div>

<?php $smarty->display("common/footer.tpl"); ?>

<script>

    $(function () {
        $('#button_edit').prop('disabled', true);
        $('#infoMessage').html(' ');
    });

    function showErrorMessage(message){
        $('#infoMessage').html(message).css('color', 'red');
        $('#button_edit').prop('disabled', true);
    }

    function validate(){
        var pattern = /[^\w\d]+/;

        var username = $('#usernameInfo').val();
        console.log(username);
        if(username.length<4 || username.length>20){
            showErrorMessage("Username must have between 4 and 20 characters.");
            return;
        }

        var usernameHasSymbols = pattern.test(username);
        if(usernameHasSymbols){
            showErrorMessage("Username can only contain characters and numbers.");
            return;
        }

        var email = $('#emailInfo').val();
        var emailIsCorrect = /[\w\d]+@[\w\d]+/.test(email);
        if(!emailIsCorrect){
            showErrorMessage("Email does not appear to be correct.");
            return;
        }

        var password = $('#passwordInfo').val();
        if(password.length<4 || password.length>20){
            showErrorMessage("Password must have between 4 and 20 characters.");
            return;
        }

        var passwordHasSymbols = pattern.test(password);
        if(passwordHasSymbols){
            showErrorMessage("Password can only contain characters and numbers.");
            return;
        }

        var passwordConf = $('#confirmPasswordInfo').val();
        if(password != passwordConf){
            showErrorMessage("Password is not matching.");
            return;
        }

        $('#button_edit').prop('disabled', false);
        $('#infoMessage').html('OK').css('color', 'green');
    }

    $('#usernameInfo, #emailInfo, #passwordInfo, #confirmPasswordInfo').on('keyup', function () {
        validate();
    });
</script>
