
<?php
session_start();

$host = "localhost";
$username = "your_mysql_username";
$password = "your_mysql_password";
$database = "your_database_name";

$conn = mysqli_connect($host, $username, $password, $database);

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $password = md5($password);

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        header('location: dashboard.php');
    } else {
            $error = "Invalid username or password!";
        }
    }
    
    ?>
    