<?php

include_once("../config/init.php");
include_once($BASE_DIR."database/questions.php");
include_once($BASE_DIR."database/members.php");
include_once($BASE_DIR."database/posts.php");
include_once($BASE_DIR."database/categories.php");

$search_categories = [];
if(isset($_GET["category"])) {
    array_push($search_categories, $_GET["category"]);
    $title = getCategory($_GET["category"])["name"];
}
else {
    foreach ($categories as $key => $value) {
        array_push($search_categories, $value['id']);
    }
    $title = "Top Questions";
}

$mostRecent = getMostRecentQuestions($search_categories,10);
foreach ($mostRecent as $key => $value) {
	$mostRecent[$key]['title'] = htmlspecialchars($value['title'], ENT_QUOTES, 'UTF-8');
}

$mostPopular = getMostPopularQuestions($search_categories,10);
foreach ($mostPopular as $key => $value) {
	$mostPopular[$key]['title'] = htmlspecialchars($value['title'], ENT_QUOTES, 'UTF-8');
}

$mostControversial = getMostControversialQuestions($search_categories,10);
foreach ($mostControversial as $key => $value) {
	$mostControversial[$key]['title'] = htmlspecialchars($value['title'], ENT_QUOTES, 'UTF-8');
}

$smarty->assign("title", $title);
$smarty->assign("recents", $mostRecent);
$smarty->assign("populars", $mostPopular);
$smarty->assign("controversials", $mostControversial);

$smarty->display("common/header.tpl");

$smarty->display("lists/home.tpl");
$smarty->display("common/footer.tpl");

