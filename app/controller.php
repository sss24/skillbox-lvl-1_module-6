<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/app/constans.php');

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

ini_set('session.gc_maxlifetime', LIFE_TIME_SESSION);
ini_set('session.cookie_lifetime', LIFE_TIME_SESSION);
session_name('session_id');
session_start();

require_once($_SERVER['DOCUMENT_ROOT'] . '/app/functions.php');

$success = false;
$errorMsg = false;

if (isset($_POST['send_form'])) {
    $allLog = require_once($_SERVER['DOCUMENT_ROOT'] . '/include/log.php');
    $allPass = require_once($_SERVER['DOCUMENT_ROOT'] . '/include/pass.php');

    $userLogin = isset($_POST['login']) ? $_POST['login'] : (isset($_COOKIE['user_login']) ? $_COOKIE['user_login'] : '');
    $userPassword = $_POST['password'];
    $loginKey = array_search($userLogin, $allLog);

    if ($loginKey !== false && $allPass[$loginKey] == $userPassword) {
        $success = true;
        $_SESSION['user'] = true;
        setcookie('user_login', $userLogin, LIFE_TIME_COOKIE, '/');
        setcookie('session_continue', 'continue', LIFE_TIME_COOKIE, '/');
    }

    $errorMsg = $success ? $errorMsg : true;

} else {
    if (isset($_SESSION['user'])) {
        setcookie('user_login', $_COOKIE['user_login'], LIFE_TIME_COOKIE, '/');
        setcookie('session_id', $_COOKIE['session_id'], time() + LIFE_TIME_SESSION, '/');
    }
}


if (isset($_GET['login']) && $_GET['login'] == 'no') {
    unset($_SESSION);
    session_destroy();
    setcookie('session_start', 'start', 1, '/');
    setcookie('session_id', null, 1, '/');
    setcookie('session_continue', null, 1, '/');

    header('Location: /?login=yes');
}