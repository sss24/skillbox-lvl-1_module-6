<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/app/constans.php');

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

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
        setcookie('user_login', $userLogin, LIFE_TIME_COOKIE, '/');

        //отвечает за старт сессии, обновляется при хите
        setcookie('session_start', 'start', LIFE_TIME_COOKIE_DOP, '/');

        //отвечает за ситуацию если истекло время жизни сессии (выводим только поля для ввода пароля)
        setcookie('session_continue', 'continue', LIFE_TIME_COOKIE, '/');

        header('Location: /');
    }
    $errorMsg = $success ? $errorMsg : true;
}

if (isset($_COOKIE['session_start'])) {
    ini_set('session.gc_maxlifetime', LIFE_TIME_SESSION);
    ini_set('session.cookie_lifetime', LIFE_TIME_SESSION);
    session_name('session_id');
    session_start();

    $_SESSION['user'] = true;
    setcookie('session_start', 'start', LIFE_TIME_COOKIE_DOP, '/');
}

if (isset($_SESSION['user']) && isset($_COOKIE['user_login'])) {
    setcookie('user_login', $_COOKIE['user_login'], LIFE_TIME_COOKIE, '/');
}

if (isset($_GET['login']) && $_GET['login'] == 'no') {
    unset($_SESSION);
    session_destroy();

    setcookie('session_start', 'start', 1, '/');
    setcookie('session_id', null, 1, '/');
    setcookie('session_continue', null, 1, '/');

    header('Location: /?login=yes');
}