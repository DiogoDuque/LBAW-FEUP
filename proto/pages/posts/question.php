<?php

    include_once ("../../config/init.php");

    include_once ($BASE_DIR."database/questions.php");
    include_once ($BASE_DIR."database/members.php");

    if (!isset($_GET['id']))
        die('Missing question ID.');

    $question_id = $_GET["id"];

    $question = $getter->getQuestion($question_id);

    $smarty->assign("getter", $getter);
    $smarty->assign("question", $question);

    $smarty->display("common/header.tpl");
    $smarty->display("posts/question.tpl");

    if (isset($_SESSION["username"])) { ?>

        <div class="new-answer">
            <h3>Your answer</h3>
            <div id="summernote" class="formgroup"></div>
            <script>
                $(document).ready(function () {
                    $('#summernote').summernote();
                });
            </script>

            <button type="submit" class="btn btn-success">Submit</button>
        </div>

    <?php } ?>

<?php $smarty->display("common/footer.tpl"); ?>
