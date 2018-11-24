<?php
function include_template($name, $data)
{
    $name = 'templates/' . $name;
    $result = '';

    if (!file_exists($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}

function formatted_price($last_price)
{
    $round_price = ceil($last_price);
    $formatted_amount = number_format($round_price, 0, ',', ' ');
    $formatted_amount .= ' ₽';
    return htmlspecialchars($formatted_amount);
}

