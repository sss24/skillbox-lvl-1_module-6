<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once($_SERVER['DOCUMENT_ROOT'] . '/app/constans.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/functions.php');

$success = '';
$errorMsg = '';

if (isset($_POST['send_form'])) {
    $allLog = require_once($_SERVER['DOCUMENT_ROOT'] . '/include/log.php');
    $allPass = require_once($_SERVER['DOCUMENT_ROOT'] . '/include/pass.php');

    $userLogin = $_POST['login'];
    $userPassword = $_POST['password'];

    $loginKey = array_search($userLogin, $allLog);
    if ($loginKey !== false && $allPass[$loginKey] == $userPassword) {
        $success = true;
    }

    $errorMsg = $success ? '' : true;
}
?>