<?php

include_once("../../config/init.php");
include_once($BASE_DIR . "database/questions.php");
include_once($BASE_DIR . "database/answers.php");
include_once($BASE_DIR . "database/members.php");
include_once($BASE_DIR . "database/votes.php");
include_once($BASE_DIR . "database/comments.php");

if(!isset($_SESSION['username']))
    die('You are not logged in!');

$userPrivilegeLevel=getMemberByUsername($_SESSION['username'])['privilege_level'];
if(!isset($userPrivilegeLevel))
    die('You are not logged in!');
else if(strcmp($userPrivilegeLevel,'Member')==0)
    die('You don\'t have permissions to see this page...');

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
                $smarty->display("admin/stats.tpl");
            ?>

        </div>


    </div>

<?php

$smarty->display('common/footer.tpl');
