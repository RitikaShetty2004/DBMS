<?php
$servername = "localhost";
$username = "root";
$password = ""; // Default XAMPP root password is empty
$database = "garment_factory";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
