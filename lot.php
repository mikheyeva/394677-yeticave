<?php
require('functions.php');

date_default_timezone_set('europe/moscow');

$link = mysqli_connect('localhost', 'root', '', 'yeticave')
or die("Ошибка" . mysqli_error($link));
mysqli_set_charset($link, "utf8");

$sql = "SELECT l.`id`, `name`, `start_price`,`url_image`, `categories_name`
FROM lots l
JOIN categories c
ON l.category_id = c.id";
$result = mysqli_query($link, $sql);
$lots = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sql_2 = "SELECT `categories_name` FROM categories ORDER BY `id`";
$result = mysqli_query($link, $sql_2);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);



echo include_template('lot.php', [
    'categories' => $categories,
    'lots' => $lots,
]);