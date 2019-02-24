<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/app/constans.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/app/functions.php');

$success = '';
$errorMsg = '';

if (isset($_POST['send_form'])) {
    $allLog = require_once($_SERVER['DOCUMENT_ROOT'] . '/include/log.php');
    $allPass = require_once($_SERVER['DOCUMENT_ROOT'] . '/include/pass.php');

    $userLogin = isset($_COOKIE['login']) ? $_COOKIE['login'] : $_POST['login'];
    $userPassword = $_POST['password'];

    $loginKey = array_search($userLogin, $allLog);

    if ($loginKey !== false && $allPass[$loginKey] == $userPassword) {
        $success = true;
        $_SESSION['user'] = true;
        setcookie('login', $userLogin, time() + 60 * 60 * 24 * 30);
    }

    $errorMsg = $success ? '' : true;
}

if (isset($_GET['login']) && $_GET['login'] == 'no') {
    unset($_SESSION);
    unset($_COOKIE['PHPSESSID']);
    session_destroy();
}


$maxlifetime = ini_get("session.gc_maxlifetime");
$cookielifetime = ini_get("session.cookie_lifetime");

//$currentCookieParams = session_get_cookie_params();
