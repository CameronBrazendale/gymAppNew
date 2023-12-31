<?php

session_start();

@include 'config.php';
@include 'model.php';

function redirect($location) {
    header("Location: $location");
    exit;
}

function loginController() {
    global $conn;

    if (isset($_POST['submit'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = $_POST['password'];

        $result = loginUser($username, $password);

        if ($result) {
            $_SESSION['user_name'] = $result['data']['username'];

            if ($result['table'] == 'member') {
                redirect('member_page.php');
            } elseif ($result['table'] == 'trainer') {
                redirect('trainer_page.php');
            }
        } else {
            $error[] = 'Incorrect username or password!';
        }
    }
}

function registerController() {
    global $conn;

    if (isset($_POST['submit'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = $_POST['password'];

        registerUser($username, $password);

        redirect('login_form.php');
    }
}

function logoutController() {
    session_unset();
    session_destroy();
    redirect('login_form.php');
}

?>
