<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $password = $_POST['password'];

    // To protect against SQL injection
    $user = stripslashes($user);
    $user = mysqli_real_escape_string($conn, $user);
    $password = stripslashes($password);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT id, password FROM users WHERE user='$user'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password is correct, start a new session
            $_SESSION['user'] = $user;
            header("Location: welcome.php");
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that user.";
    }
}

$conn->close();
?>