<?php

    include_once ("../../config/init.php");

    include_once ($BASE_DIR."database/questions.php");
    include_once ($BASE_DIR."database/posts.php");
    include_once ($BASE_DIR."database/members.php");
    include_once ($BASE_DIR."database/categories.php");

    if (!isset($_GET['id']))
        die('Missing question ID.');

    $question_id = $_GET["id"];

    $question = getQuestion($question_id);
    $question_post = getPost($question_id);
    $question_author = getMember($question["author_id"]);
    $question_category = getCategory($question["category_id"]);

    $smarty->assign("question", $question);
    $smarty->assign("question_post", $question_post);
    $smarty->assign("question_author", $question_author);
    $smarty->assign("question_category", $question_category);

    $smarty->display("common/header.tpl");
    $smarty->display("posts/question.tpl");

    if ($logged_in) { ?>

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
