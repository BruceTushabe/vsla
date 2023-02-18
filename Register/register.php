<?php
        // Validate the form data
        if (isset($_POST['register'])) {
            $fullname = $_POST['fullname'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            // Check if the passwords match
            if ($password != $confirm_password) {
                echo '<div class="error">Error: Passwords do not match</div>';
            } else {
                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Connect to the database
                $servername = 'localhost';
                $db_username = 'yourusername';
                $db_password = 'yourpassword';
                $dbname = 'yourdatabase';

                $conn = new mysqli($servername, $db_username, $db_password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die('Connection failed: ' . $conn->connect_error);
                }

                // Check if the username already exists
                $sql = "SELECT * FROM users WHERE username='$username'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<div class="error">Error: Username already exists</div>';
                } else {
                    // Insert the new user into the database
                    $sql = "INSERT INTO users (fullname, username, password) VALUES ('$fullname', '$username', '$hashed_password')";
                    if ($conn->query($sql) === TRUE) {
                        header('Location: login.php');
                        exit();
                    } else {
                        echo '<div class="error">Error: ' . $conn->error . '</div>';
                    }
                }

                // Close the database connection
                $conn->close();
            }
        }
        ?>