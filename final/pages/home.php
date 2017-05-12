<?php

include_once("../config/init.php");
include_once($BASE_DIR."database/questions.php");
include_once($BASE_DIR."database/members.php");
include_once($BASE_DIR."database/posts.php");
include_once($BASE_DIR."database/categories.php");

$search_categories = [];
if(isset($_GET["category"]))
    array_push( $search_categories,$_GET["category"]);
else
    foreach($categories as $key => $value) {
        array_push( $search_categories, $value['id']);
    }

$mostRecent = getMostRecentQuestions($search_categories,10);
$mostPopular = getMostPopularQuestions($search_categories,10);
$mostControversial = getMostControversialQuestions($search_categories,10);


$smarty->assign("recents", $mostRecent);
$smarty->assign("populars", $mostPopular);
$smarty->assign("controversials", $mostControversial);

$smarty->display("common/header.tpl");

$smarty->display("lists/home.tpl");
$smarty->display("common/footer.tpl");
