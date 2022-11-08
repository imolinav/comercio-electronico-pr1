<?php
session_start();
require_once 'database/Connection.php';

// $conexion = Connection::make();
date_default_timezone_set("Europe/Madrid");

function redirect($type) {
    if($type === 'GET') {
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