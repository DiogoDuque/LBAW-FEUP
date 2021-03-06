<?php

include_once("../../config/init.php");
include_once($BASE_DIR . "database/questions.php");
include_once($BASE_DIR . "database/answers.php");
include_once($BASE_DIR . "database/members.php");
include_once($BASE_DIR . "database/votes.php");
include_once($BASE_DIR . "database/comments.php");

if(!isset($_SESSION['username']))
{
    $_SESSION['error_messages'] = "You are not logged in.";
    $destination = $BASE_URL . "pages/home.php";

    header("refresh:3;url={$destination}");
    $smarty->assign('redirect_destiny', $destination);
    $smarty->display('common/info.tpl');
    die();
}

$userPrivilegeLevel=getMemberByUsername($_SESSION['username'])['privilege_level'];
if(!isset($userPrivilegeLevel))
{
    $_SESSION['error_messages'] = "You are not logged in.";
    $destination = $BASE_URL . "pages/home.php";

    header("refresh:3;url={$destination}");
    $smarty->assign('redirect_destiny', $destination);
    $smarty->display('common/info.tpl');
    die();
}
else if(strcmp($userPrivilegeLevel,'Member')==0){
    $_SESSION['error_messages'] = "You don't have permissions to view this page.";
    $destination = $BASE_URL . "pages/home.php";

    header("refresh:3;url={$destination}");
    $smarty->assign('redirect_destiny', $destination);
    $smarty->display('common/info.tpl');
    die();
}

$smarty->display("common/header.tpl");

$totalNumberOfQuestions = getNumberOfQuestions();
$totalNumberOfAnswers = getNumberOfAnswers();
$totalNumberOfMembers = getNumberOfMembers();
$totalNumberOfVotes = getNumberOfVotes();
$totalNumberOfComments = getNumberOfComments();

$smarty->assign("totalNumberOfQuestions", $totalNumberOfQuestions);
$smarty->assign("totalNumberOfAnswers", $totalNumberOfAnswers);
$smarty->assign("totalNumberOfMembers", $totalNumberOfMembers);
$smarty->assign("totalNumberOfVotes", $totalNumberOfVotes);
$smarty->assign("totalNumberOfComments", $totalNumberOfComments);

?>

    <link rel="stylesheet" type="text/css" href="<?= $BASE_URL ?>lib/css/admin.css">

    <div class="container">
        <div class="row">

            <?php
                $smarty->display("admin/side_menu.tpl");
                $smarty->display("admin/general_stats.tpl");
            ?>

        </div>


    </div>

<?php

$smarty->display('common/footer.tpl');
