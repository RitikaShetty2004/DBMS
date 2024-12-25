<?php
$conn = new mysqli("localhost", "owner", "p123", "garment_factory");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $producer_id = $_POST['producerId'] ?? '';
    $producer_name = $_POST['producerName'] ?? '';
    $producer_address = $_POST['produceraddress'] ?? '';
    $raw_material = $_POST['rawmaterial'] ?? '';
    $phone_number = $_POST['PhoneNumber'] ?? '';
    $garment_factory_id = $_POST['garment_factoryID'] ?? '';

    switch ($action) {
        case 'save':
            $sql = "INSERT INTO producer (P_ID, P_NAME, P_ADDRESS, P_RAWMATERIAL, P_PHONE, G_ID) 
                    VALUES ('$producer_id', '$producer_name', '$producer_address', '$raw_material', '$phone_number', '$garment_factory_id')";
            if ($conn->query($sql) === TRUE) {
                echo "Producer details saved successfully!<br>";

                // Fetch and display the saved producer data
                $searchSql = "SELECT * FROM producer WHERE P_ID = '$producer_id'";
                $result = $conn->query($searchSql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "Producer Details:<br>";
                        echo "ID: " . $row['P_ID'] . "<br>";
                        echo "Name: " . $row['P_NAME'] . "<br>";
                        echo "Address: " . $row['P_ADDRESS'] . "<br>";
                        echo "Raw Material: " . $row['P_RAWMATERIAL'] . "<br>";
                        echo "Phone Number: " . $row['P_PHONE'] . "<br>";
                        echo "Garment Factory ID: " . $row['G_ID'] . "<br>";
                    }
                } else {
                    echo "No producer found with ID: $producer_id";
                }
            } else {
                echo "Error: " . $conn->error;
            }
            break;

        case 'delete':
            $sql = "DELETE FROM producer WHERE P_ID = '$producer_id'";
            if ($conn->query($sql) === TRUE) {
                echo "Producer deleted successfully!";
            } else {
                echo "Error: " . $conn->error;
            }
            break;

        case 'update':
            $sql = "UPDATE producer SET 
                        P_NAME='$producer_name', 
                        P_ADDRESS='$producer_address', 
                        P_RAWMATERIAL='$raw_material', 
                        P_PHONE='$phone_number', 
                        G_ID='$garment_factory_id' 
                    WHERE P_ID='$producer_id'";
            if ($conn->query($sql) === TRUE) {
                echo "Producer updated successfully!";
            } else {
                echo "Error: " . $conn->error;
            }
            break;

        case 'search':
            $sql = "SELECT * FROM producer WHERE P_ID = '$producer_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "Producer Details:<br>";
                    echo "ID: " . $row['P_ID'] . "<br>";
                    echo "Name: " . $row['P_NAME'] . "<br>";
                    echo "Address: " . $row['P_ADDRESS'] . "<br>";
                    echo "Raw Material: " . $row['P_RAWMATERIAL'] . "<br>";
                    echo "Phone Number: " . $row['P_PHONE'] . "<br>";
                    echo "Garment Factory ID: " . $row['G_ID'] . "<br>";
                }
            } else {
                echo "No producer found with ID: $producer_id";
            }
            break;

        default:
            echo "Invalid action.";
            break;
    }
}

$conn->close();
?>
