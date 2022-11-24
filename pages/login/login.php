<?php
if (isset($_GET['email']) && isset($_GET['password'])) {
    require_once(__DIR__.'/../../database.php');
    $user = getUser($connection, $_GET['email']);
    if (empty($user) || !password_verify($_GET['password'], $user['password'])) {
        $response = array('status' => 'error', 'message' => 'Invalid user credentials');
        echo json_encode($response);
    } else {
        unset($user['password']);
        $response = array('status' => 'success', 'message' => 'Correctly logged in', 'data' => $user);
        echo json_encode($response);
    }
} else {
    include 'pages/shared/header/header.view.phtml';
    include 'pages/login/login.view.phtml';
    include 'pages/shared/footer/footer.view.phtml';
}

function getUser($connection, $user_email) {
    $stmt = mysqli_prepare($connection, "SELECT `id`, `name`, `surname`, `email`, `password` FROM user WHERE `email` = ?");
    mysqli_stmt_bind_param($stmt, "s", $user_email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    return $result;
}

?>