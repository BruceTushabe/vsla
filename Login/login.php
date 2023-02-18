<?php
session_start();
include('config.php');

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username)) {
        $error = "Username is required";
    } else if (empty($password)) {
        $error = "Password is required";
    } else {
        $query = "SELECT * FROM users WHERE username='$username' AND password='" . md5($password) . "'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $_SESSION['username'] = $username;
            header('location: dashboard.php');
        } else {
            $error = "Invalid username or password";
        }
    }
}
?>
