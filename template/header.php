<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/controller.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="/template/styles.css" rel="stylesheet"/>
    <title>Project - ведение списков</title>
</head>

<body>

<div class="header">
    <div class="logo"><img src="/template/i/logo.png" width="68" height="23" alt="Project"/></div>
    <div style="clear: both"></div>
    <?php siteMenu(SORT_ASC) ?>
</div>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td class="left-collum-index">

            <h1>Возможности проекта —</h1>
            <p>Вести свои личные списки, например покупки в магазине, цели, задачи и многое другое. Делится списками с
                друзьями и просматривать списки друзей.</p>
        </td>
        <td class="right-collum-index">

            <div class="project-folders-menu">
                <ul class="project-folders-v">
                    <?php if (isset($_SESSION['user'])): ?>
                        <li><a href="/?login=no">Выход</a></li>
                    <?php else: ?>
                        <li class="project-folders-v-active"><a href="/?login=yes">Авторизация</a></li>
                    <?php endif; ?>
                    <li><a href="/?register=yes">Регистрация</a></li>
                    <li><a href="/?pass=yes">Забыли пароль?</a></li>
                </ul>
                <div style="clear: both;"></div>
            </div>
            <div class="index-auth">
                <?php if (isset($success) && !$success): ?>
                    <?php if (isset($_GET['login']) && ($_GET['login'] == 'yes')) : ?>

                        <form class="index-auth" method="POST" action="<?= $_SERVER['PHP_SELF'] . '?login=yes'; ?>">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">

                                <?php if (isset($_COOKIE['session_continue'])): ?>
                                    <span>Вы заходили к нам под логином: </span><span class="aut-user-login"> <?= $_COOKIE['user_login']; ?></span>
                                <?php else : ?>
                                    <tr>
                                        <td class="iat">Ваш e-mail: <br/> <input type="text" size="30" name="login" value="<?= $userLogin ?? ''; ?>"/>
                                        </td>
                                    </tr>
                                <?php endif; ?>

                                <tr>
                                    <td class="iat">Ваш пароль: <br/> <input type="password" size="30" name="password" value="<?= $userPassword ?? ''; ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="submit" name="send_form" value="Войти"/></td>
                                </tr>
                            </table>
                        </form>

                    <?php endif; ?>
                <?php else: ?>
                    <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/include/success.php'; ?>
                <?php endif; ?>
                <div>
                    <?php if (isset($errorMsg) && $errorMsg) : ?>
                        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/include/error.php'; ?>
                    <?php endif; ?>
                </div>
            </div>

        </td>
    </tr>
</table>
<h1 style="text-align: center"><?= showTitle(); ?></h1>
<br>
