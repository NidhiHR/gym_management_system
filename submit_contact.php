<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $place = $_POST['place'];
    $message = $_POST['message'];

    $fullName = stripslashes($fullName);
    $email = stripslashes($email);
    $place = stripslashes($place);
    $message = stripslashes($message);
    $fullName = mysqli_real_escape_string($conn, $fullName);
    $email = mysqli_real_escape_string($conn, $email);
    $place = mysqli_real_escape_string($conn, $place);
    $message = mysqli_real_escape_string($conn, $message);

    $sql = "INSERT INTO messages (full_name, email, place, message) VALUES ('$fullName', '$email', '$place', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo ('connection  successful!');
        header("Location: homepage.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>