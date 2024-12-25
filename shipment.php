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
    $SHP_ID = $_POST['shipmentId'] ?? '';
    $SHP_TYP = $_POST['shipmenttype'] ?? '';
    $SHP_COST = $_POST['shipmentcost'] ?? '';
    $SHP_FRTO = $_POST['shipmentfromto'] ?? '';
    $SHP_PHONE = $_POST['PhoneNumber'] ?? '';

    // Validate Shipment ID
    if (empty($SHP_ID)) {
        echo "Shipment ID cannot be empty.";
    } else {
        switch ($action) {
            case 'save':
                // Check for duplicate Shipment ID
                $checkSql = "SELECT SHP_ID FROM shipment WHERE SHP_ID = '$SHP_ID'";
                $checkResult = $conn->query($checkSql);

                if ($checkResult->num_rows > 0) {
                    echo "Error: Shipment ID already exists. Please use a unique ID.";
                } else {
                    // Insert new shipment into the database
                    $sql = "INSERT INTO shipment (SHP_ID, SHP_TYP, SHP_COST, SHP_FRTO, SHP_PHONE) 
                            VALUES ('$SHP_ID', '$SHP_TYP', '$SHP_COST', '$SHP_FRTO', '$SHP_PHONE')";
                    if ($conn->query($sql) === TRUE) {
                        echo "Shipment details saved successfully!<br>";

                        // Fetch and display the saved shipment data
                        $searchSql = "SELECT * FROM shipment WHERE SHP_ID = '$SHP_ID'";
                        $result = $conn->query($searchSql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "Shipment Details:<br>";
                                echo "ID: " . $row['SHP_ID'] . "<br>";
                                echo "Type: " . $row['SHP_TYP'] . "<br>";
                                echo "Cost: " . $row['SHP_COST'] . "<br>";
                                echo "From-To: " . $row['SHP_FRTO'] . "<br>";
                                echo "Phone: " . $row['SHP_PHONE'] . "<br>";
                            }
                        } else {
                            echo "No shipment found with ID: $SHP_ID";
                        }
                    } else {
                        echo "Error: " . $conn->error;
                    }
                }
                break;

            case 'delete':
                // Delete shipment by ID
                $sql = "DELETE FROM shipment WHERE SHP_ID = '$SHP_ID'";
                if ($conn->query($sql) === TRUE) {
                    echo "Shipment deleted successfully!";
                } else {
                    echo "Error: " . $conn->error;
                }
                break;

            case 'update':
                // Update shipment details
                $sql = "UPDATE shipment SET 
                        SHP_TYP='$SHP_TYP', 
                        SHP_COST='$SHP_COST', 
                        SHP_FRTO='$SHP_FRTO', 
                        SHP_PHONE='$SHP_PHONE' 
                        WHERE SHP_ID='$SHP_ID'";
                if ($conn->query($sql) === TRUE) {
                    echo "Shipment updated successfully!";
                } else {
                    echo "Error: " . $conn->error;
                }
                break;

            case 'search':
                // Search shipment by ID
                $sql = "SELECT * FROM shipment WHERE SHP_ID = '$SHP_ID'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "Shipment Details:<br>";
                        echo "ID: " . $row['SHP_ID'] . "<br>";
                        echo "Type: " . $row['SHP_TYP'] . "<br>";
                        echo "Cost: " . $row['SHP_COST'] . "<br>";
                        echo "From-To: " . $row['SHP_FRTO'] . "<br>";
                        echo "Phone: " . $row['SHP_PHONE'] . "<br>";
                    }
                } else {
                    echo "No shipment found with ID: $SHP_ID";
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
