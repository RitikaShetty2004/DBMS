<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "owner";
$password = "p123";
$database = "garment_factory";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $factory_id = $_POST['factory_id'];
    $factory_name = $_POST['factory_name'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];

    echo "Factory ID: $factory_id<br>";
    echo "Factory Name: $factory_name<br>";
    echo "Address: $address<br>";
    echo "Phone Number: $phone_number<br>";

    $sql = "INSERT INTO garment_factory (G_ID, G_NAME, G_ADDRESS, G_PHONE) 
            VALUES ('$factory_id', '$factory_name', '$address', $phone_number)";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data saved successfully');</script>";
    } else {
        echo "Error: " . $conn->error . "<br>SQL: " . $sql;
    }
}

$conn->close();
?>
