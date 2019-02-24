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
    <? siteMenu(SORT_ASC) ?>
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
<!--                    <li class="project-folders-v-active"><span>Авторизация</span></li>-->
                    <? if (!empty($_SESSION['user'])): ?>
                        <li><a href="/?login=no">Выход</a></li>
                    <? else: ?>
                        <li class="project-folders-v-active"><a href="/?login=yes">Авторизация</a></li>
                    <? endif; ?>
                    <li><a href="/?register=yes">Регистрация</a></li>
                    <li><a href="/?pass=yes">Забыли пароль?</a></li>
                </ul>
                <div style="clear: both;"></div>
            </div>
            <div class="index-auth">
                <? if (empty($success)): ?>
                    <? if (isset($_GET['login']) && $_GET['login'] == 'yes') : ?>

                        <form class="index-auth" method="POST" action="<?= $_SERVER['PHP_SELF'] . '?login=yes'; ?>">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <? if (isset($_COOKIE['login'])): ?>
                                    <span>Вы заходили к нам под логином: </span><span class="aut-user-login"> <?= $_COOKIE['login']; ?></span>
                                <? else : ?>
                                    <tr>
                                        <td class="iat">Ваш e-mail: <br/> <input type="text" size="30" name="login" value="<?= $userLogin ?? ''; ?>"/>
                                        </td>
                                    </tr>
                                <? endif; ?>
                                <tr>
                                    <td class="iat">Ваш пароль: <br/> <input type="password" size="30" name="password" value="<?= $userPassword ?? ''; ?>"/>
                                    </td>
                                </tr>
                                <tr>
                                    <td><input type="submit" name="send_form" value="Войти"/></td>
                                </tr>
                            </table>
                        </form>

                    <? endif; ?>
                <? else: ?>
                    <? require_once $_SERVER['DOCUMENT_ROOT'] . '/include/success.php'; ?>
                <? endif; ?>
                <div>
                    <? if ($errorMsg == true) : ?>
                        <? require_once $_SERVER['DOCUMENT_ROOT'] . '/include/error.php'; ?>
                    <? endif; ?>
                </div>
            </div>

        </td>
    </tr>
</table>
<h1 style="text-align: center"><?= showTitle(); ?></h1>
<br>
