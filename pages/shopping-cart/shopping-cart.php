<?php
require_once(__DIR__.'/../../database.php');
if ($_COOKIE['userId']) {
    $shoppingCart = getShoppingCart($connection, $_COOKIE['userId']);
}

include 'pages/shared/header/header.view.phtml';
include 'pages/shopping-cart/shopping-cart.view.phtml';
include 'pages/shared/footer/footer.view.phtml';

function getShoppingCart($connection, $userId) {
    $stmt = mysqli_prepare($connection, "SELECT * FROM purchase WHERE `user_id` = ? AND `finished_at` IS NULL");
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $shoppingCart = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    if (!empty($shoppingCart) && isset($shoppingCart)) {
        $stmt_products = mysqli_prepare($connection, "SELECT COUNT(p.id) as quantity, p.id, p.name, p.price, p.offer, LOWER(REPLACE(p.name, ' ', '-')) as link FROM product p, purchase_has_product k WHERE p.id = k.product_id AND k.purchase_id = ? GROUP BY (p.id)");
        mysqli_stmt_bind_param($stmt_products, "i", $shoppingCart['id']);
        mysqli_stmt_execute($stmt_products);
        $result = mysqli_fetch_all(mysqli_stmt_get_result($stmt_products), MYSQLI_ASSOC);
        $shoppingCart['products'] = $result;
    }
    return $shoppingCart;
}

?>