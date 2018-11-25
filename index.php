<?php
require('functions.php');

date_default_timezone_set('europe/moscow');

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

$categories = ['Доски и лыжи', 'Крепления', 'Ботинки', 'Одежда', 'Инструменты', 'Разное'];
$promo_list = [
    [
        'title' => 'Доски и лыжи',
        'appellation' => '2014 Rossignol District Snowboard',
        'price' => 10999,
        'url' => 'img/lot-1.jpg'
    ],
    [
        'title' => 'Доски и лыжи',
        'appellation' => 'DC Ply Mens 2016/2017 Snowboard',
        'price' => 159999,
        'url' => 'img/lot-1.jpg'
    ],
    [
        'title' => 'Крепления',
        'appellation' => 'Крепления Union Contact Pro 2015 года размер L/XL',
        'price' => 8000,
        'url' => 'img/lot-3.jpg'
    ],
    [
        'title' => 'Ботинки',
        'appellation' => 'Ботинки для сноуборда DC Mutiny Charocal',
        'price' => 10999,
        'url' => 'img/lot-4.jpg'
    ],
    [
        'title' => 'Одежда',
        'appellation' => 'Куртка для сноуборда DC Mutiny Charocal',
        'price' => 7500,
        'url' => 'img/lot-5.jpg'
    ],

    [
        'title' => 'Разное',
        'appellation' => 'Маска Oakley  anti_xssCanopy',
        'price' => 5400,
        'url' => 'img/lot-6.jpg'
    ]
];

$index_list = [
    'categories' => $categories,
    'promo_list' => $promo_list,
    'formatted_time' => $formatted_time,
];

$index_data = include_template('index.php', $index_list);
echo include_template('layout.php', [
    'content' => $index_data,
    'title' => $title,
    'categories' => $categories,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
]);




