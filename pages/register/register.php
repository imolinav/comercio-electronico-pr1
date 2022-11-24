<?php
if (isset($_POST['register'])) {
    require_once(__DIR__.'/../../database.php');
    $data = json_decode($_POST['register'], true);
    if (checkUser($connection, $data['email']) === 0) {
        $user = createUser($connection, $data['name'], $data['surname'], $data['email'], $data['birthDate'], password_hash($data['password'], PASSWORD_DEFAULT, ['cost' => 10]));
        if (empty($user)) {
            $response = array('status' => 'error', 'message' => 'There was an error creating the user');
            echo json_encode($response);
        } else {
            $response = array('status' => 'success', 'message' => 'User created correctly', 'data' => $user);
            echo json_encode($response);
        }
    } else {
        $response = array('status' => 'error', 'message' => 'Email already in use');
        echo json_encode($response);
    }
} else {
    include 'pages/shared/header/header.view.phtml';
    include 'pages/register/register.view.phtml';
    include 'pages/shared/footer/footer.view.phtml';
}

function createUser($connection, $user_name, $user_surname, $user_email, $user_birth_date, $user_password) {
    $stmt = mysqli_prepare($connection, "INSERT INTO user (`name`, `surname`, `email`, `password`, `birth_date`) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssss", $user_name, $user_surname, $user_email, $user_password, $user_birth_date);
    mysqli_stmt_execute($stmt);
    return getUser($connection, mysqli_insert_id($connection));
}

function checkUser($connection, $user_email) {
    $stmt = mysqli_prepare($connection, "SELECT email FROM user WHERE `email` = ?");
    mysqli_stmt_bind_param($stmt, "s", $user_email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return $result->num_rows;
}

function getUser($connection, $user_id) {
    $stmt = mysqli_prepare($connection, "SELECT `id`, `name`, `surname`, `email`, `password` FROM user WHERE `id` = ?");
    mysqli_stmt_bind_param($stmt, "s", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
    return $result;
}

?>