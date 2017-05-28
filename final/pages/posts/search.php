<?php

include_once("../../config/init.php");
include_once ($BASE_DIR."database/categories.php");
include_once ($BASE_DIR."database/questions.php");

$url = preg_replace('/&page=(\d+)/','',$_SERVER['QUERY_STRING']);
$query = "";
$search_titles = false;
$search_descriptions = false;
$search_answers = false;
$search_order = "Most Recent";
$search_categories = [];
$limit = 10;
$page = 1;
foreach($categories as $key => $value) {
    $categories[$key]['checked'] = true;
}

$orders =  [
    "Most Recent" => "date DESC",
    "Least Recent" => "date",
    "Best Score" => "score DESC",
    "Worst Score" => "score"
];

//Set form
if(isset($_GET["query"]))
    $query = htmlspecialchars($_GET["query"], ENT_QUOTES, 'UTF-8');

if(isset($_GET["search_titles"]))
    $search_titles = $_GET['search_titles'];
if(isset($_GET["search_descriptions"]))
    $search_descriptions = $_GET['search_descriptions'];
if(isset($_GET["search_answers"]))
    $search_answers = $_GET['search_answers'];
if(isset($_GET["search_order"]))
    $search_order = $_GET['search_order'];
if(isset($_GET["limit"]))
    $limit = $_GET['limit'];
if(isset($_GET["page"]))
    $page = $_GET['page'];
if(isset($_GET["search_categories"])){
    $search_categories = $_GET['search_categories'];
    foreach($categories as $key => $value) {
        $categories[$key]['checked'] = in_array($categories[$key]['id'], $search_categories);
    }
}

if(count($search_categories) == 0)
    foreach($categories as $key => $value) {
        array_push( $search_categories, $value['id']);
    }

if(!$search_descriptions && !$search_answers )
    $search_titles = true;

//Search
$results = [];
if($query != "")
    $results = search($query, $search_titles, $search_descriptions,$search_answers,$orders[$search_order],$search_categories,$limit,$page);

$smarty->assign("query", $query);
$smarty->assign("search_titles", $search_titles);
$smarty->assign("search_descriptions", $search_descriptions);
$smarty->assign("search_answers", $search_answers);
$smarty->assign("search_order", $search_order);
$smarty->assign("orders", $orders);
$smarty->assign("categories", $categories);
$smarty->assign("limit", $limit);


$smarty->assign("page", $page);
$smarty->assign("url", $url);


$smarty->assign("results", $results);

$smarty->display("common/header.tpl");
$smarty->display("forms/search_form.tpl");

if($query != "")
    $smarty->display("lists/search_results.tpl");

$smarty->display("common/footer.tpl"); ?>

