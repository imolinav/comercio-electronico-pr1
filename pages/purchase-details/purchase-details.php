<?php
require_once(__DIR__.'/../../database.php');
if (isset($_POST['add_payment_method'])) {
    $data = json_decode($_POST['add_payment_method'], true);

    $paymentMethods = addPaymentMethod($connection, $_COOKIE['userId'], $data['type'], $data['value']);

    if(isset($paymentMethods) && !empty($paymentMethods)) {
        $response = array('status' => 'success', 'message' => 'Payment method added', 'data' => $paymentMethods);
        echo json_encode($response);
    } else {
        $response = array('status' => 'error', 'message' => 'Payment method could\'nt be added');
        echo json_encode($response);
    }

} else if (isset($_POST['add_direction'])) {

    $data = json_decode($_POST['add_direction'], true);

    $paymentMethods = addSendingDestination($connection, $_COOKIE['userId'], $data['name'], $data['surname'], $data['street'], $data['postalCode'], $data['country'], $data['phone'], $data['email']);

    if(isset($paymentMethods) && !empty($paymentMethods)) {
        $response = array('status' => 'success', 'message' => 'Direction added', 'data' => $paymentMethods);
        echo json_encode($response);
    } else {
        $response = array('status' => 'error', 'message' => 'Direction could\'nt be added');
        echo json_encode($response);
    }

} else if (isset($_POST['process_purchase'])) {
    $data = json_decode($_POST['process_purchase'], true);

    $shoppingCart = processPurchase($connection, $data['userId'], $data['direction'], $data['paymentMethod']);

    if(isset($shoppingCart) && !empty($shoppingCart)) {
        $response = array('status' => 'success', 'message' => 'Purchase processed', 'data' => $shoppingCart);
        echo json_encode($response);
    } else {
        $response = array('status' => 'error', 'message' => 'Couldn\'t process the purchase');
        echo json_encode($response);
    }
} else {

    if ($_COOKIE['userId']) {
        $shoppingCart = getShoppingCart($connection, $_COOKIE['userId']);
        $paymentMethods = getPaymentMethods($connection, $_COOKIE['userId']);
        $sendingDestinations = getSendingDestinations($connection, $_COOKIE['userId']);
        $total = 0;
        if (isset($shoppingCart) && !empty($shoppingCart)) {
            foreach($shoppingCart['products'] as $product) {
                if (isset($product['offer']) && !empty($product['offer'])) {
                    $total += $product['offer'] * $product['quantity'];
                } else {
                    $total += $product['price'] * $product['quantity'];
                }
            }
        }
    }
    
    include 'pages/shared/header/header.view.phtml';
    include 'pages/purchase-details/purchase-details.view.phtml';
    include 'pages/shared/footer/footer.view.phtml';
}

function getShoppingCart($connection, $userId) {
    $stmt = mysqli_prepare($connection, "SELECT * FROM purchase WHERE `user_id` = ? AND `finished_at` IS NULL");
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $shoppingCart = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    if (!empty($shoppingCart) && isset($shoppingCart)) {
        $stmt_products = mysqli_prepare($connection, "SELECT COUNT(p.id) as quantity, p.id, p.name, p.price, p.offer, LOWER(REPLACE(p.name, ' ', '-')) as link FROM product p, purchase_has_product k WHERE p.id = k.product_id AND k.purchase_id = ? GROUP BY (p.id)");
        mysqli_stmt_bind_param($stmt_products, "s", $shoppingCart['id']);
        mysqli_stmt_execute($stmt_products);
        $result = mysqli_fetch_all(mysqli_stmt_get_result($stmt_products), MYSQLI_ASSOC);
        $shoppingCart['products'] = $result;
    }
    return $shoppingCart;
}

function getLastPurchase($connection, $userId) {
    $stmt = mysqli_prepare($connection, "SELECT * FROM purchase WHERE `user_id` = ? ORDER BY `finished_at` LIMIT 1");
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $shoppingCart = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    if (!empty($shoppingCart) && isset($shoppingCart)) {
        $stmt_products = mysqli_prepare($connection, "SELECT COUNT(p.id) as quantity, p.id, p.name, p.price, p.offer, LOWER(REPLACE(p.name, ' ', '-')) as link FROM product p, purchase_has_product k WHERE p.id = k.product_id AND k.purchase_id = ? GROUP BY (p.id)");
        mysqli_stmt_bind_param($stmt_products, "s", $shoppingCart['id']);
        mysqli_stmt_execute($stmt_products);
        $result = mysqli_fetch_all(mysqli_stmt_get_result($stmt_products), MYSQLI_ASSOC);
        $shoppingCart['products'] = $result;
    }
    return $shoppingCart;
}

function getPaymentMethods($connection, $userId) {
    $stmt = mysqli_prepare($connection, "SELECT * FROM `payment_method` WHERE `user_id` = ?");
    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    return $result;
}

function addPaymentMethod($connection, $userId, $paymentType, $paymentValue) {
    if ($paymentType == 1) {
        $stmt = mysqli_prepare($connection, "INSERT INTO `payment_method` (`user_id`, `payment_type`, `paypal_user`) VALUES (?, 1, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $userId, $paymentValue);
    } else {
        $stmt = mysqli_prepare($connection, "INSERT INTO `payment_method` (`user_id`, `payment_type`, `credit_card`) VALUES (?, 2, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $userId, $paymentValue);
    }
    mysqli_stmt_execute($stmt);
    return getPaymentMethods($connection, $userId);
}

function getSendingDestinations($connection, $userId) {
    $stmt = mysqli_prepare($connection, "SELECT * FROM `direction` WHERE `user_id` = ?");
    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    return $result;
}

function addSendingDestination($connection, $userId, $userName, $userSurname, $userStreet, $userPostalCode, $userCountry, $userPhone, $userEmail) {
    $stmt = mysqli_prepare($connection, "INSERT INTO `direction` (`user_id`, `name`, `surname`, `street`, `postal_code`, `country`, `phone`, `email`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssssisss", $userId, $userName, $userSurname, $userStreet, $userPostalCode, $userCountry, $userPhone, $userEmail);
    mysqli_stmt_execute($stmt);
    return getSendingDestinations($connection, $userId);
}

function processPurchase($connection, $userId, $direction, $paymentMethod) {
    $shoppingCart = getShoppingCart($connection, $userId);
    if(!isset($shoppingCart) || empty($shoppingCart)) {
        return null;
    }
    $stmt = mysqli_prepare($connection, "UPDATE `purchase` SET `user_direction` = ?, `user_payment` = ?, `finished_at` = CURRENT_TIMESTAMP WHERE `id` = ?");
    mysqli_stmt_bind_param($stmt, "iii", $direction, $paymentMethod, $shoppingCart['id']);
    mysqli_stmt_execute($stmt);
    return getLastPurchase($connection, $userId);
}

?>