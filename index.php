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
$formatted_time = $hours . ':' . ($minutes < 10 ? '0'.$minutes : $minutes);

$sql = "SELECT l.`id`, `name`, `start_price`,`url_image`, `categories_name`
FROM lots l
JOIN categories c
ON l.category_id = c.id";
$result = mysqli_query($link, $sql);
$lots = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql_2 = "SELECT `categories_name` FROM categories";
$result = mysqli_query($link, $sql_2);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

$index_list = [
    'categories' => $categories,
    'formatted_time' => $formatted_time,
    'link' => $link,
    'lots' => $lots
];



if (isset ($_GET['id'])){
    $_GET['id'] = htmlspecialchars($promo['id']);
    $url = http_build_query($_GET);
}
else {
    return response(view('test'), 404);
}



$index_data = include_template('index.php', $index_list);
echo include_template('layout.php', [
    'content' => $index_data,
    'title' => $title,
    'categories' => $categories,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'link' => $link,
    'url' => $url,
]);




