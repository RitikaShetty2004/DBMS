<?php
// Database connection
$conn = new mysqli("localhost", "owner", "p123", "garment_factory");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $distributer_id = $_POST['distributerId'] ?? '';
    $distributer_name = $_POST['distributerName'] ?? '';
    $distributer_address = $_POST['distributeraddreess'] ?? '';
    $phone_number = $_POST['PhoneNumber'] ?? '';
    $garment_factory_id = $_POST['garment_factoryID'] ?? '';

    // Check for empty distributor ID
    if (empty($distributer_id)) {
        echo "Distributer ID is required.";
    } else {
        switch ($action) {
            case 'save':
                // Insert new distributer into the database
                $sql = "INSERT INTO distributer (D_ID, D_NAME, D_ADDRESS, D_PHONE, G_ID) 
                        VALUES ('$distributer_id', '$distributer_name', '$distributer_address', '$phone_number', '$garment_factory_id')";
                if ($conn->query($sql) === TRUE) {
                    echo "Distributer details saved successfully!<br>";

                    // Fetch and display the saved distributer data
                    $searchSql = "SELECT * FROM distributer WHERE D_ID = '$distributer_id'";
                    $result = $conn->query($searchSql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "Distributer Details:<br>";
                            echo "ID: " . $row['D_ID'] . "<br>";
                            echo "Name: " . $row['D_NAME'] . "<br>";
                            echo "Address: " . $row['D_ADDRESS'] . "<br>";
                            echo "Phone Number: " . $row['D_PHONE'] . "<br>";
                            echo "Garment Factory ID: " . $row['G_ID'] . "<br>";
                        }
                    } else {
                        echo "No distributer found with ID: $distributer_id";
                    }
                } else {
                    echo "Error: " . $conn->error;
                }
                break;

            case 'delete':
                // Delete distributer by ID
                $sql = "DELETE FROM distributer WHERE D_ID = '$distributer_id'";
                if ($conn->query($sql) === TRUE) {
                    echo "Distributer deleted successfully!";
                } else {
                    echo "Error: " . $conn->error;
                }
                break;

            case 'update':
                // Update distributer details
                $sql = "UPDATE distributer SET 
                        D_NAME='$distributer_name', 
                        D_ADDRESS='$distributer_address', 
                        D_PHONE='$phone_number', 
                        G_ID='$garment_factory_id' 
                        WHERE D_ID='$distributer_id'";
                if ($conn->query($sql) === TRUE) {
                    echo "Distributer updated successfully!";
                } else {
                    echo "Error: " . $conn->error;
                }
                break;

            case 'search':
                // Search distributer by ID
                $sql = "SELECT * FROM distributer WHERE D_ID = '$distributer_id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "Distributer Details:<br>";
                        echo "ID: " . $row['D_ID'] . "<br>";
                        echo "Name: " . $row['D_NAME'] . "<br>";
                        echo "Address: " . $row['D_ADDRESS'] . "<br>";
                        echo "Phone Number: " . $row['D_PHONE'] . "<br>";
                        echo "Garment Factory ID: " . $row['G_ID'] . "<br>";
                    }
                } else {
                    echo "No distributer found with ID: $distributer_id";
                }
                break;

            default:
                echo "Invalid action.";
                break;
        }
    }
}

$conn->close();
?>
