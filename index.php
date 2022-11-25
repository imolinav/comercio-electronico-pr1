<?php
session_start();
require_once 'database.php';
date_default_timezone_set("Europe/Madrid");

function redirect($type) {
    if ($type === 'GET') {
        header('Location: index.php');
    }
}

$_COOKIE['locale'] = 'es';
if (isset($_POST['locale'])) {
    $_COOKIE['locale'] = $_POST['locale'];
    header('Location: ' . $_POST['page']);
} else if (isset($_SESSION['locale'])) {
    $_COOKIE['locale'] = $_SESSION['locale'];
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

?>