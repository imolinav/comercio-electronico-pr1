<?php
session_start();
require_once 'database.php';
date_default_timezone_set("Europe/Madrid");

function redirect($type) {
    if ($type === 'GET') {
        header('Location: index.php');
    }
}

if (!isset($_COOKIE['locale']) || empty($_COOKIE['locale'])) {
    $_COOKIE['locale'] = 'es';
}
if (isset($_POST['locale'])) {
    $language = json_decode($_POST['locale'], true)['language'];
    $_COOKIE['locale'] = $language;
    $response = array('status' => 'error', 'message' => 'Language updated');
    echo json_encode($response);
    return;
}

if (isset($_COOKIE['userId']) && !empty($_COOKIE['userId']) && !strpos($_COOKIE['userId'], 'e_')) {
    $user = getUser($_COOKIE['userId'], $connection);
}

include 'internationalization/' . $_COOKIE['locale'] . '.php';

$request = $_SERVER['REQUEST_URI'];
if (strpos($request, '?')) {
    $request = explode('?', $request)[0];
}

switch ($request) {
    case '/' :
        require __DIR__ . '/pages/home/home.php';
        break;
    case '' :
        require __DIR__ . '/pages/home/home.php';
        break;
    case '/login' :
        require __DIR__ . '/pages/login/login.php';
        break;
    case '/product' :
        require __DIR__ . '/pages/product/product.php';
        break;
    case '/purchase-details' :
        require __DIR__ . '/pages/purchase-details/purchase-details.php';
        break;
    case '/receipt' :
        require __DIR__ . '/pages/receipt/receipt.php';
        break;
    case '/register' :
        require __DIR__ . '/pages/register/register.php';
        break;
    case '/search' :
        require __DIR__ . '/pages/search/search.php';
        break;
    case '/shopping-cart' :
        require __DIR__ . '/pages/shopping-cart/shopping-cart.php';
        break;
    default :
        require __DIR__ . '/pages/product/product.php';
        break; 
}

function getUser($userId, $connection) {
    $stmt = mysqli_prepare($connection, "SELECT `id`, `name`, `surname`, `email`, `password` FROM user WHERE `id` = ?");
    mysqli_stmt_bind_param($stmt, "s", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    return $result;
}

?>