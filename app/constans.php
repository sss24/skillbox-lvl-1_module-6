<?php
/**
 * PATH_MENU - путь к массиву меню
 */
define('PATH_MENU', $_SERVER['DOCUMENT_ROOT'] . '/app/main_menu.php');

/**
 * LIFE_TIME_SESSION - время жизни сессии (20 мин)
 */
define('LIFE_TIME_SESSION', 60 * 20);
//define('LIFE_TIME_SESSION', 15);

/**
 * LIFE_TIME_COOKIE - время жизни куки (30 суток)
 */
define('LIFE_TIME_COOKIE', time() + 60 * 60 * 24 * 30);