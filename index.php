<?php
require('functions.php');

date_default_timezone_set('europe/moscow');

$link = mysqli_connect('localhost', 'root', '', 'yeticave')
or die("Ошибка" . mysqli_error($link));
mysqli_set_charset($link, "utf8");

$title = 'Главная';

$is_auth = rand(0, 1);
$user_name = 'Имяпользователя'; // укажите здесь ваше имя
$user_name = htmlspecialchars($user_name);
$user_avatar = 'img/user.jpg';

$end_of_auction = strtotime('midnight tomorrow');
$diff = $end_of_auction - time();
$hours = floor($diff / 3600);
$minutes = floor(($diff % 3600) / 60);
$formatted_time = $hours . ':' . $minutes;

$sql = "SELECT l.`name`, `start_price`,`url_image`, `categories_name`
FROM lots l
JOIN categories c
ON l.category_id = c.id";
$result = mysqli_query($link, $sql);
$lots = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql_2 = "SELECT `categories_name` FROM categories";
$result = mysqli_query($link, $sql_2);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

//$categories = ['Доски и лыжи', 'Крепления', 'Ботинки', 'Одежда', 'Инструменты', 'Разное'];
//$promo_list = [
//    [
//        'title' => 'Доски и лыжи',
//        'appellation' => '2014 Rossignol District Snowboard',
//        'price' => 10999,
//        'url' => 'img/lot-1.jpg'
//    ],
//    [
//        'title' => 'Доски и лыжи',
//        'appellation' => 'DC Ply Mens 2016/2017 Snowboard',
//        'price' => 159999,
//        'url' => 'img/lot-1.jpg'
//    ],
//    [
//        'title' => 'Крепления',
//        'appellation' => 'Крепления Union Contact Pro 2015 года размер L/XL',
//        'price' => 8000,
//        'url' => 'img/lot-3.jpg'
//    ],
//    [
//        'title' => 'Ботинки',
//        'appellation' => 'Ботинки для сноуборда DC Mutiny Charocal',
//        'price' => 10999,
//        'url' => 'img/lot-4.jpg'
//    ],
//    [
//        'title' => 'Одежда',
//        'appellation' => 'Куртка для сноуборда DC Mutiny Charocal',
//        'price' => 7500,
//        'url' => 'img/lot-5.jpg'
//    ],
//
//    [
//        'title' => 'Разное',
//        'appellation' => 'Маска Oakley  anti_xssCanopy',
//        'price' => 5400,
//        'url' => 'img/lot-6.jpg'
//    ]
//];

$index_list = [
    'categories' => $categories,
//    'promo_list' => $promo_list,
    'formatted_time' => $formatted_time,
    'link' => $link,
    'lots' => $lots
];

$index_data = include_template('index.php', $index_list);
echo include_template('layout.php', [
    'content' => $index_data,
    'title' => $title,
    'categories' => $categories,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'link' => $link,
]);




