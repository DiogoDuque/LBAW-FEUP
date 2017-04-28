<?php

include_once ("../../config/init.php");
include_once ($BASE_DIR."database/categories.php");

$name = $_POST['name'];
$id = addCategory($name);

$response_array['name'] = $name;
if ($id >= 0)
    $response_array['status'] = 'success';
else
    $response_array['status'] = 'error';
header('Content-type: application/json');
echo json_encode($response_array);

//echo $id;