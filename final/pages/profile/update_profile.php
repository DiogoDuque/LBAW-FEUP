<?php

include_once("../../config/init.php");
include ($BASE_DIR."database/members.php");

?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:url"           content="{$BASE_URL}" />


    <link rel="stylesheet" type="text/css" href= "{$BASE_URL}vendors/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href= "{$BASE_URL}lib/css/main.css">

    <!--  include jquery and boostrap  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- include summernote css/js (text editor) -->
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>


</head>
<div class="modal fade" id="signUp-modal" role="dialog">
    <div class="modal-dialog">
        <!--Content here-->
        <div class="modal-content">
            <!-- The Header-->


            <!-- Body(form)-->
            <div class="modal-body">
                <form action="../../actions/member/update_profile_action.php" method="post">
                    <input type='hidden' name='posted' value='true'>

                    <div class="form-group">
                        <label for="username"><span class="glyphicon glyphicon-user"></span> New username</label>
                        <input name="username" type="text" class="form-control" id="username_signup" placeholder="Enter username" required>
                    </div>
                    <div class="form-group">
                        <label for="email"><span class="glyphicon glyphicon-envelope"></span> New email</label>
                        <input name="email" type="email" class="form-control" id="email_signup" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> New password</label>
                        <input name="password" type="password" class="form-control" id="psw_signup" placeholder="Enter password" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-block" id="button_signup"><span
                            class="glyphicon glyphicon-registration-mark"></span> Save Changes
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>