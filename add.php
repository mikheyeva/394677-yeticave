<?php
require('functions.php');

date_default_timezone_set('europe/moscow');

$link = mysqli_connect('localhost', 'root', '', 'yeticave')
or die("Ошибка" . mysqli_error($link));
mysqli_set_charset($link, "utf8");

$sql_2 = "SELECT `categories_name` FROM categories ORDER BY `id`";
$result = mysqli_query($link, $sql_2);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
//
//if (!empty($_POST)) {
//    echo '<pre>';
//    var_dump($_POST);
//    echo '</pre>';
//}

$form_errors = [];

if (!empty($_POST)) {
    if (!empty($_POST['lot-name']) && !empty($_POST['category']) && !empty($_POST['message']) && !empty($_POST['lot-rate']) && !empty($_POST['lot-step']) && !empty($_POST['lot-date'])) {
        // запись в базу
    } else {
        if (empty($_POST['lot-name'])) {
            $form_errors['lot-name'] = true;
        }
        if (empty($_POST['category'])) {
            $form_errors['category'] = true;
        }
        if (empty($_POST['message'])) {
            $form_errors['message'] = true;
        }
        if (empty($_POST['lot-rate'])) {
            $form_errors['lot-rate'] = true;
        }
        if (empty($_POST['lot-step'])) {
           $form_errors['lot-step'] = true;
        }
        if (empty($_POST['lot-date'])) {
            $form_errors['lot-date'] = true;
        }
    }
}

if (isset($_POST["lot-name"])&& isset($_POST["message"]) && isset($_POST["lot-rate"]) && isset($_POST["lot-step"]) && isset($_POST["lot-date"]) && isset($_POST["lot-rate"]) && isset($_POST["photo"])) {
    $sql_form = mysqli_query($link, "INSERT INTO `lots` (`name`, `description`,`url_image`, `start_price`, `bet_step`) VALUES ('{$_POST['lot-name']}', '{$_POST['message']}' , 
'{$_POST['photo']}' , '{$_POST['lot-rate']}' , '{$_POST['lot-step']}')");
    if ($sql_form) {
        echo '<p>Данные успешно добавлены в таблицу.</p>';
    } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
    }
}
//
//echo '<pre>';
//var_dump($form_errors);
//echo '</pre>';

$lot_data = include_template('add.php', [
    'categories' => $categories,
    'form_errors' => $form_errors,
]);

echo include_template('layout.php', [
    'content' => $lot_data,
    'title' => $title,
    'categories' => $categories,
    'is_auth' => $is_auth,
    'user_name' => $user_name,
    'link' => $link,
]);