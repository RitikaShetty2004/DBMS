<?php
// Database connection
$conn = new mysqli("localhost", "owner", "p123", "garment_factory");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve POST data
    $action = $_POST['action'];
    $store_id = $_POST['storeId'] ?? '';
    $store_name = $_POST['storeName'] ?? '';
    $store_address = $_POST['storeaddress'] ?? '';
    $phone_number = $_POST['PhoneNumber'] ?? '';

    // Validate Store ID
    if (empty($store_id)) {
        echo "Store ID is required.";
    } else {
        switch ($action) {
            case 'save':
                // Check for duplicate Store ID
                $checkSql = "SELECT STR_ID FROM stores WHERE STR_ID = '$store_id'";
                $checkResult = $conn->query($checkSql);

                if ($checkResult->num_rows > 0) {
                    echo "Error: Store ID already exists. Please use a unique ID.";
                } else {
                    // Insert new store into the database
                    $sql = "INSERT INTO stores (STR_ID, STR_NAME, STR_ADDRESS, STR_PHONE) 
                            VALUES ('$store_id', '$store_name', '$store_address', '$phone_number')";
                    if ($conn->query($sql) === TRUE) {
                        echo "Store details saved successfully!<br>";

                        // Fetch and display the saved store data
                        $searchSql = "SELECT * FROM stores WHERE STR_ID = '$store_id'";
                        $result = $conn->query($searchSql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "Store Details:<br>";
                                echo "ID: " . $row['STR_ID'] . "<br>";
                                echo "Name: " . $row['STR_NAME'] . "<br>";
                                echo "Address: " . $row['STR_ADDRESS'] . "<br>";
                                echo "Phone: " . $row['STR_PHONE'] . "<br>";
                            }
                        } else {
                            echo "No store found with ID: $store_id";
                        }
                    } else {
                        echo "Error: " . $conn->error;
                    }
                }
                break;

            case 'delete':
                // Delete store by ID
                $sql = "DELETE FROM stores WHERE STR_ID = '$store_id'";
                if ($conn->query($sql) === TRUE) {
                    echo "Store deleted successfully!";
                } else {
                    echo "Error: " . $conn->error;
                }
                break;

            case 'update':
                // Update store details
                $sql = "UPDATE stores SET 
                        STR_NAME='$store_name', 
                        STR_ADDRESS='$store_address', 
                        STR_PHONE='$phone_number' 
                        WHERE STR_ID='$store_id'";
                if ($conn->query($sql) === TRUE) {
                    echo "Store updated successfully!";
                } else {
                    echo "Error: " . $conn->error;
                }
                break;

            case 'search':
                // Search store by ID
                $sql = "SELECT * FROM stores WHERE STR_ID = '$store_id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "Store Details:<br>";
                        echo "ID: " . $row['STR_ID'] . "<br>";
                        echo "Name: " . $row['STR_NAME'] . "<br>";
                        echo "Address: " . $row['STR_ADDRESS'] . "<br>";
                        echo "Phone: " . $row['STR_PHONE'] . "<br>";
                    }
                } else {
                    echo "No store found with ID: $store_id";
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
