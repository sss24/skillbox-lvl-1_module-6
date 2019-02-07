<?php

/**
 * Возврощает текущий URI
 * @return string текущий URI
 */
function queryParam(): string
{
    return $_SERVER['REQUEST_URI'];
}

/**
 * Сортирует массив по ключу
 * @param array $array - Массив для сартировки
 * @param int $sort - Метод сартировки
 * @param string $key - По какому ключу сортировать
 */
function array_sort(array &$array, int $sort = SORT_ASC, string $key = 'sort')
{
    usort($array, function ($a, $b) use ($key, $sort) {
        return $sort == SORT_DESC ? $b[$key] <=> $a[$key] : $a[$key] <=> $b[$key];
    });
}

/**
 * Выводит меню, используя массив из файла /app/main_menu.php
 * @param string $sort Сортировка пунктов меню, по умолчанию не сортирует
 * @param string $flat Задает класс (horizontal или vertical), по умолчанию horizontal
 */
function siteMenu(string $sort = '', string $flat = 'horizontal')
{
    $menu = require PATH_MENU;
    $queryString = queryParam();
    $str = '';

    array_sort($menu, $sort);
    require $_SERVER['DOCUMENT_ROOT'] . '/template/template_menu.php';
}

/**
 * Возвращает Title текущей страницы
 * @return string - Title
 */
function showTitle(): string
{
    $menu = require PATH_MENU;
    $queryString = queryParam();

    foreach ($menu as $k => $v) {
        if (strpos($queryString, $v['path']) !== false) {
            return $v['title'];
        }
    }
    return '';
}

/**
 * Обрезает строку если она привышает $max_size символов
 * @param string $title - Исходная строка
 * @param int $max_size - Максимальное количество символов в строке
 * @return string - Первые 12 символов строки
 */
function cutTitle(string $title = '', int $max_size = 12): string
{
    if (strlen($title) > $max_size) {
        $str = substr($title, 0, $max_size);
        return $str . '...';
    }
    return $title;
}
