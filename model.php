<?php

function loginUser($username, $password) {
    global $conn;

    $hashedPassword = md5($password);

    $selectMember = "SELECT * FROM member WHERE username = '$username' AND password = '$hashedPassword'";
    $resultMember = mysqli_query($conn, $selectMember);

    if (mysqli_num_rows($resultMember) > 0) {
        return ['table' => 'member', 'data' => mysqli_fetch_assoc($resultMember)];
    }

    $selectTrainer = "SELECT * FROM trainer WHERE username = '$username' AND password = '$hashedPassword'";
    $resultTrainer = mysqli_query($conn, $selectTrainer);

    if (mysqli_num_rows($resultTrainer) > 0) {
        return ['table' => 'trainer', 'data' => mysqli_fetch_assoc($resultTrainer)];
    }

    return false;
}

function registerUser($username, $password) {
    global $conn;

    $hashedPassword = md5($password);

    $insert = "INSERT INTO member (username, password) VALUES ('$username', '$hashedPassword')";
    mysqli_query($conn, $insert);
}

?>
