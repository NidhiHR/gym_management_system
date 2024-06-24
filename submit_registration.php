<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['mail'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $referral_method = $_POST['method'];
    $emergency_contact_name = $_POST['emergency_contact_name'];
    $emergency_contact_phone = $_POST['emergency_contact_phone'];
    $membership_type = $_POST['membership_type'];
    $membership_duration = $_POST['membership_duration'];
    $membership_plan = $_POST['membership_plan'];

    // SQL injection prevention
    $name = stripslashes($name);
    $email = stripslashes($email);
    $phone = stripslashes($phone);
    $dob = stripslashes($dob);
    $city = stripslashes($city);
    $state = stripslashes($state);
    $referral_method = stripslashes($referral_method);
    $emergency_contact_name = stripslashes($emergency_contact_name);
    $emergency_contact_phone = stripslashes($emergency_contact_phone);
    $membership_type = stripslashes($membership_type);
    $membership_duration = stripslashes($membership_duration);
    $membership_plan = stripslashes($membership_plan);

    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);
    $phone = mysqli_real_escape_string($conn, $phone);
    $dob = mysqli_real_escape_string($conn, $dob);
    $city = mysqli_real_escape_string($conn, $city);
    $state = mysqli_real_escape_string($conn, $state);
    $referral_method = mysqli_real_escape_string($conn, $referral_method);
    $emergency_contact_name = mysqli_real_escape_string($conn, $emergency_contact_name);
    $emergency_contact_phone = mysqli_real_escape_string($conn, $emergency_contact_phone);
    $membership_type = mysqli_real_escape_string($conn, $membership_type);
    $membership_duration = mysqli_real_escape_string($conn, $membership_duration);
    $membership_plan = mysqli_real_escape_string($conn, $membership_plan);

    $sql = "INSERT INTO Join_page (name, email, phone, dob, city, state, referral_method, emergency_contact_name, emergency_contact_phone, membership_type, membership_duration, membership_plan) 
            VALUES ('$name', '$email', '$phone', '$dob', '$city', '$state', '$referral_method', '$emergency_contact_name', '$emergency_contact_phone', '$membership_type', '$membership_duration', '$membership_plan')";

    if ($conn->query($sql) === TRUE) {

        // echo ('registration successful!');
        header("Location: homepage.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>