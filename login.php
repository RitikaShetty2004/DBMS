<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Replace with your actual credentials
    $valid_username = "owner";
    $valid_password = "p123";

    // Validate credentials
    if ($username === $valid_username && $password === $valid_password) {
        // Store login state in session
        $_SESSION['owner_logged_in'] = true;

        // Redirect to the owner_choice.html page
        header("Location: owner_choice.php");
        exit();
    } else {
        // Invalid credentials
        echo "<script>alert('Invalid username or password!'); window.location.href = 'login.html';</script>";
        exit();
    }
} else {
    // If the request method is not POST, redirect back to the login page
    header("Location: login.html");
    exit();
}
?>
