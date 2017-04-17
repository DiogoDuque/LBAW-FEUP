<?php

session_set_cookie_params(3600, '/~lbaw1623'); //FIXME
session_start();

error_reporting(E_ERROR | E_WARNING); // E_NOTICE by default

$BASE_DIR = "/opt/lbaw/lbaw1623/public_html/LBAW-FEUP/proto/"; // == website/
$BASE_URL = "/~lbaw1623/LBAW-FEUP/proto/"; //FIXME

$conn = new PDO('pgsql:host=dbm; dbname=lbaw1623', 'lbaw1623', 'bj66ak24');  // FIXME
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

include_once($BASE_DIR . '/vendors/smarty/Smarty.class.php');

$smarty = new Smarty;

$smarty->template_dir = $BASE_DIR . 'templates/';
$smarty->compile_dir = $BASE_DIR . 'templates_c/';

$smarty->assign('BASE_DIR', $BASE_DIR);
$smarty->assign('BASE_URL', $BASE_URL);

$smarty->assign('ERROR_MESSAGES', $_SESSION['error_messages']);
$smarty->assign('FIELD_ERRORS', $_SESSION['field_errors']);
$smarty->assign('SUCCESS_MESSAGES', $_SESSION['success_messages']);
$smarty->assign('FORM_VALUES', $_SESSION['form_values']);
$smarty->assign('USERNAME', $_SESSION['username']);

unset($_SESSION['success_messages']);
unset($_SESSION['error_messages']);
unset($_SESSION['field_errors']);
unset($_SESSION['form_values']);

$smarty->force_compile = true;

?>