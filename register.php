<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $gender = $_POST['gender'];

    if ($password !== $confirmPassword) {
        die("Passwords do not match.");
    }

    // Escape user inputs to prevent SQL injection
    $fullName = mysqli_real_escape_string($conn, $fullName);
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);
    $phoneNumber = mysqli_real_escape_string($conn, $phoneNumber);
    $gender = mysqli_real_escape_string($conn, $gender);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement for register table
    $sql_register = "INSERT INTO register (full_name, username, email, phone_number, password, gender) VALUES ('$fullName', '$username', '$email', '$phoneNumber', '$hashed_password', '$gender')";

    // Execute SQL statement for register table
    if ($conn->query($sql_register) === TRUE) {
        echo "<script>alert('Registration successful!');</script>";
    } else {
        echo "Error: " . $sql_register . "<br>" . $conn->error;
    }

    // Prepare SQL statement for username table
    $sql_username = "INSERT INTO username (user, password) VALUES ('$username', '$hashed_password')";

    // Execute SQL statement for username table
    if ($conn->query($sql_username) === TRUE) {

        header("Location: homepage.html");

    } else {

        echo "Error: " . $sql_username . "<br>" . $conn->error;
    }

    $conn->close();
}
?>