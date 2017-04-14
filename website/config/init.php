<?php

session_set_cookie_params(3600, '/~lbaw1623'); //FIXME
session_start();

error_reporting(E_ERROR | E_WARNING); // E_NOTICE by default

$BASE_DIR = dirname(dirname(__FILE__), 1) . "/"; // == website/
$BASE_URL = '/LBAW-FEUP/website/'; //FIXME

$conn = new PDO('pgsql:host=localhost; port=5432; dbname=postgres', 'postgres', 'postgres');  // FIXME
$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

include_once($BASE_DIR . '/vendors/smarty/Smarty.class.php');

$smarty = new Smarty;

$smarty->template_dir = $BASE_DIR . 'templates/';
$smarty->compile_dir = $BASE_DIR . 'templates_c/';

$smarty->assign('BASE_URL', $BASE_URL); // FIXME

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