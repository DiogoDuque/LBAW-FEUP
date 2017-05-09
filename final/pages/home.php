<?php

include_once("../config/init.php");
include_once($BASE_DIR."database/questions.php");
include_once($BASE_DIR."database/members.php");
include_once($BASE_DIR."database/posts.php");
include_once($BASE_DIR."database/categories.php");

$smarty->display("common/header.tpl");

$mostRecent = getMostRecentQuestions(10);
$mostPopular = getMostPopularQuestions(10);
$mostControversial = getMostControversialQuestions(10);


?>

    <!--Content-->
    <div class="container">
        <!--Tabs-->
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#recent">Recent</a></li>
            <li><a data-toggle="tab" href="#popular">Most Popular</a></li>
            <li><a data-toggle="tab" href="#controversial">Most Controversial</a></li>
        </ul>

        <!--TODO: Make a template of question/answer and put it in the templates folder.-->

        <!--Tabs Content-->
        <div class="tab-content">

            <!--MOST RECENT -->
            <div id="recent" class="tab-pane fade in active">

                <?php

                foreach ($mostRecent as $question) {

                    $question_post = getPost($question['post_id']);
                    $question_author = getMemberById($question_post['author_id']);
                    $question_category = getCategory($question['category_id']);

                    $smarty->assign("question", $question);
                    $smarty->assign("question_post", $question_post);
                    $smarty->assign("question_author", $question_author);
                    $smarty->assign("question_category", $question_category);
                    $smarty->display('lists/question_list_item.tpl');
                }

                ?>

            </div>

            <hr class="main-menu-questions-divider">

            <!--MOST POPULAR-->
            <div id="popular" class="tab-pane fade">
                <?php

                foreach ($mostPopular as $question) {

                    $question_post = getPost($question['post_id']);
                    $question_author = getMemberById($question_post['author_id']);
                    $question_category = getCategory($question['category_id']);

                    $smarty->assign("question", $question);
                    $smarty->assign("question_post", $question_post);
                    $smarty->assign("question_author", $question_author);
                    $smarty->assign("question_category", $question_category);
                    $smarty->display('lists/question_list_item.tpl');
                }

                ?>
            </div>

            <!--MOST CONTROVERSE-->
            <div id="controversial" class="tab-pane fade">
                <?php

                foreach ($mostRecent as $question) {

                    $question_post = getPost($question['post_id']);
                    $question_author = getMemberById($question_post['author_id']);
                    $question_category = getCategory($question['category_id']);

                    $smarty->assign("question", $question);
                    $smarty->assign("question_post", $question_post);
                    $smarty->assign("question_author", $question_author);
                    $smarty->assign("question_category", $question_category);
                    $smarty->display('lists/question_list_item.tpl');
                }

                ?>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../lib/js/home.js"></script>



<?php $smarty->display("common/footer.tpl"); ?>
