<?php
require_once(__DIR__.'/../../database.php');

if (isset($_GET['purchase_id']) && !empty($_GET['purchase_id'])) {

    $purchase = getPurchaseById($connection, $_COOKIE['userId'], $_GET['purchase_id']);

    $total = 0;
    if (isset($purchase) && !empty($purchase)) {
        foreach($purchase['products'] as $product) {
            if (isset($product['offer']) && !empty($product['offer'])) {
                $total += $product['offer'] * $product['quantity'];
            } else {
                $total += $product['price'] * $product['quantity'];
            }
        }
    }
    
}

include 'pages/shared/header/header.view.phtml';
include 'pages/receipt/receipt.view.phtml';
include 'pages/shared/footer/footer.view.phtml';

function getPurchaseById($connection, $userId, $purchaseId) {
    $stmt = mysqli_prepare($connection, "SELECT * FROM purchase WHERE `id` = ? AND `user_id` = ?");
    mysqli_stmt_bind_param($stmt, "is", $purchaseId, $userId);
    mysqli_stmt_execute($stmt);
    $purchase = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    if (!empty($purchase) && isset($purchase)) {
        $stmt_products = mysqli_prepare($connection, "SELECT COUNT(p.id) as quantity, p.id, p.name, p.price, p.offer, LOWER(REPLACE(p.name, ' ', '-')) as link FROM product p, purchase_has_product k WHERE p.id = k.product_id AND k.purchase_id = ? GROUP BY (p.id)");
        mysqli_stmt_bind_param($stmt_products, "i", $purchase['id']);
        mysqli_stmt_execute($stmt_products);
        $result = mysqli_fetch_all(mysqli_stmt_get_result($stmt_products), MYSQLI_ASSOC);
        $purchase['products'] = $result;
    }
    return $purchase;
}

?>