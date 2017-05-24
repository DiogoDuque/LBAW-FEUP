<?php

include_once("../../config/init.php");
include_once ($BASE_DIR."database/members.php");

?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:url"           content="<?=$BASE_URL?>" />


    <link rel="stylesheet" type="text/css" href= "<?=$BASE_URL?>vendors/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href= "<?=$BASE_URL?>lib/css/main.css">

    <!--  include jquery and boostrap  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- include summernote css/js (text editor) -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>


</head>
<div class="row">
    <div class="col-lg-5 col-offset-6 centered"></div>
    <form class="form-horizontal" action="../../actions/member/update_profile_action.php" method="post">
    <fieldset>
        <div class="title">
            <h1 class="">Edit Profile</h1>
        </div>
        <div class="control-group">
            <!-- Username -->
            <label class="control-label"  for="username">Username</label>
            <div class="controls">
                <input type="text" id="username" name="username" placeholder="" class="input-xlarge">
            </div>
        </div>

        <div class="control-group">
            <!-- E-mail -->
            <label class="control-label" for="email">E-mail</label>
            <div class="controls">
                <input type="text" id="email" name="email" placeholder="" class="input-xlarge">
            </div>
        </div>

        <div class="control-group">
            <!-- Password-->
            <label class="control-label" for="password">Password</label>
            <div class="controls">
                <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
            </div>
        </div>
        <div class="control-group">
            <!-- Button -->
            <div class="controls">
                <button class="btn btn-success">Save Changes</button>
            </div>
        </div>
    </fieldset>
</form>
</div>