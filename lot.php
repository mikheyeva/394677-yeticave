<?php
require('functions.php');

date_default_timezone_set('europe/moscow');

$link = mysqli_connect('localhost', 'root', '', 'yeticave')
or die("Ошибка" . mysqli_error($link));
mysqli_set_charset($link, "utf8");

$end_of_auction = strtotime('midnight tomorrow');
$diff = $end_of_auction - time();
$hours = floor($diff / 3600);
$minutes = floor(($diff % 3600) / 60);
$formatted_time = $hours . ':' . ($minutes < 10 ? '0'.$minutes : $minutes);

$sql_2 = "SELECT `categories_name` FROM categories ORDER BY `id`";
$result = mysqli_query($link, $sql_2);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset ($_GET['id'])) {
    $lotId = $_GET['id'];
} else {
    return response(view('Ошибка'), 404);
}


$sql = "SELECT l.`name`, `url_image`, categories_name, l.`id`, `description`, `bet_step`, `start_price`
FROM lots l
JOIN categories c
ON l.category_id = c.id
WHERE l.`id` = '" . $lotId . "'";

$sql2 = "SELECT max(user_amount) as amount
FROM wager
WHERE lot_id = '" . $lotId . "'";

$lot = null;
$result = mysqli_query($link, $sql);
$lots = mysqli_fetch_all($result, MYSQLI_ASSOC);

$wager = null;
$max_amount = null;
$result2 = mysqli_query($link, $sql2);
$wagers = mysqli_fetch_all($result2, MYSQLI_ASSOC);

if (!empty($lots[0])) {
    $lot = $lots[0];
}

if (!empty($wagers[0])) {
    $wager = $wagers[0];
    $max_amount = $wager['amount'];
}

if (!empty($max_amount)) {
    $current_price = formatted_price(htmlspecialchars($max_amount));
} else {
    $current_price = formatted_price(htmlspecialchars($lot['start_price']));
}

//echo '<pre>';
//var_dump($max_amount);
//echo '</pre>';
//die();

echo include_template('lot.php', [
    'categories' => $categories,
    'sql' => $sql,
    'lot' => $lot,
    'formatted_time' => $formatted_time,
    'max_amount' => $max_amount,
    'current_price' => $current_price,
]);