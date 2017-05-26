<?php

include_once("../../config/init.php");
$smarty->display("common/header.tpl");

?>

    <link rel="stylesheet" type="text/css" href="<?= $BASE_URL ?>lib/css/admin.css">

    <div class="container">
        <div class="row">

            <?php $smarty->display("admin/side_menu.tpl"); ?>

            <div class="col-md-9">

            </div>

        </div>

    </div>

<?php

$smarty->display('common/footer.tpl');


