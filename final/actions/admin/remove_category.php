<?php

include_once ("../../config/init.php");
include_once ($BASE_DIR."database/categories.php");

$id = $_POST['id'];
$id = deleteCategory($id);

echo json_encode($id);
//echo $id;