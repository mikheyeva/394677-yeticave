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

//$form_errors = [];

//if (!empty($_POST)) {
//    if (!empty($_POST['lot-name']) && !empty($_POST['category']) && !empty($_POST['message']) && !empty($_POST['lot-rate']) && !empty($_POST['lot-step']) && !empty($_POST['lot-date'])) {
//        // запись в базу
//    } else {
//        if (empty($_POST['lot-name'])) {
//            $form_errors['lot-name'] = true;
//        }
//        if (empty($_POST['category'])) {
//            $form_errors['category'] = true;
//        }
//        if (empty($_POST['message'])) {
//            $form_errors['message'] = true;
//        }
//        if (empty($_POST['lot-rate'])) {
//            $form_errors['lot-rate'] = true;
//        }
//        if (empty($_POST['lot-step'])) {
//           $form_errors['lot-step'] = true;
//        }
//        if (empty($_POST['lot-date'])) {
//            $form_errors['lot-date'] = true;
//        }
//    }
//}


$lot_name = mysqli_real_escape_string($link, $_POST['lot-name']);
$category = mysqli_real_escape_string($link, $_POST['category']);
$description = mysqli_real_escape_string($link, $_POST['message']);
$start_price = intval($_POST['lot-rate']);
$bet_step = intval($_POST['lot-step']);
$lot_date = mysqli_real_escape_string($link, $_POST['lot-date']);

$image_name = mysqli_real_escape_string($link, $_FILES['photo']['name']);

$add_lot = [
    'lot_name' => $lot_name,
    'category' => $category,
    'description' => $description,
    'start_price' => $start_price,
    'bet_step' => $bet_step,
//    'lot_date' => $lot_date
];

$load_error = false;

if ($_FILES['photo']['error'] == 1) {
    $load_error = true;;
    $answer = 'Ошибка загрузки фотографии';
} else {
    $file_name = $_FILES['photo']['name'];
    $file_path = __DIR__ . '/img/';
    $file_url = '/img/' . $file_name;

    move_uploaded_file($_FILES['photo']['tmp_name'], $file_path . $file_name);

    $sql_add_photo = mysqli_query($link, "INSERT INTO `lots` l (`url_image`) VALUES $image_name");
    if (isset ($add_lot)) {
        $sql_form = mysqli_query($link, "INSERT INTO `lots` l (`name`, `categories_name`, `description`,`start_price`, `bet_step` ) VALUES " . implode('","', $add_lot) . " JOIN categories c
ON l.category_id = c.id");
        if ($sql_form) {
            $answer = 'Новый лот добавлен';
        } else {
            $load_error = true;
            $answer = 'Пожалуйста, исправьте ошибки в форме';
        }
    }
}


//echo '<pre>';
//var_dump($_FILES);
//echo '</pre>';
//die();

//if (isset($_POST['lot-name']) && isset($_POST['message']) && isset($_POST['lot-rate']) && isset($_POST['lot-step']) && isset($_POST['lot-date']) && isset($_POST['lot-rate']) && isset($_POST['photo'])) {
//    $sql_form = mysqli_query($link, "INSERT INTO `lots` (`name`, `description`,`url_image`, `start_price`, `bet_step`) VALUES ('{$_POST['lot-name']}', '{$_POST['message']}' ,
//'{$_POST['photo']}' , '$start_price' , '$bet_step')");
//    if ($sql_form) {
//        $success = 'Новый лот добавлен';
//    } else {
//        $failure = 'Пожалуйста, исправьте ошибки в форме';
//        $success = $failure;
//    }
//}
//


$path = '/img';

if (isset($_FILES['photo'])) {
    // проверяем, можно ли загружать изображение
    $check = can_upload($_FILES['photo']);

    if ($check === true) {
        // загружаем изображение на сервер
        make_upload($_FILES['photo']);
        echo "<strong>Файл успешно загружен!</strong>";
    } else {
        // выводим сообщение об ошибке
        echo "<strong>$check</strong>";
    }
}

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
    'success' => $success,
    'failure' => $failure,
]);