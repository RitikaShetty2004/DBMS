<?php
$conn = new mysqli("localhost", "owner", "p123", "garment_factory");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    $employee_id = $_POST['employeeId'] ?? '';
    $first_name = $_POST['FirstName'] ?? '';
    $last_name = $_POST['LastName'] ?? '';
    $address = $_POST['Address'] ?? '';
    $work_hours = $_POST['WorkHours'] ?? '';
    $salary = $_POST['Salary'] ?? '';
    $phone_number = $_POST['PhoneNumber'] ?? '';
    $garment_factory_id = $_POST['garment_factoryID'] ?? '';

    switch ($action) {
        case 'save':
            $sql = "INSERT INTO employee (employee_id, first_name, last_name, address, work_hours, salary, phone_number, garment_factory_id) 
                    VALUES ('$employee_id', '$first_name', '$last_name', '$address', '$work_hours', '$salary', '$phone_number', '$garment_factory_id')";
            if ($conn->query($sql) === TRUE) {
                echo "Employee details saved successfully!<br>";

                // Fetch and display the saved employee data
                $searchSql = "SELECT * FROM employee WHERE employee_id = '$employee_id'";
                $result = $conn->query($searchSql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "Employee Details:<br>";
                        echo "ID: " . $row['employee_id'] . "<br>";
                        echo "First Name: " . $row['first_name'] . "<br>";
                        echo "Last Name: " . $row['last_name'] . "<br>";
                        echo "Address: " . $row['address'] . "<br>";
                        echo "Work Hours: " . $row['work_hours'] . "<br>";
                        echo "Salary: " . $row['salary'] . "<br>";
                        echo "Phone Number: " . $row['phone_number'] . "<br>";
                        echo "Garment Factory ID: " . $row['garment_factory_id'] . "<br>";
                    }
                } else {
                    echo "No employee found with ID: $employee_id";
                }
            } else {
                echo "Error: " . $conn->error;
            }
            break;

        case 'delete':
            $sql = "DELETE FROM employee WHERE employee_id = '$employee_id'";
            if ($conn->query($sql) === TRUE) {
                echo "Employee deleted successfully!";
            } else {
                echo "Error: " . $conn->error;
            }
            break;

        case 'update':
            $sql = "UPDATE employee SET 
                        first_name='$first_name', 
                        last_name='$last_name', 
                        address='$address', 
                        work_hours='$work_hours', 
                        salary='$salary', 
                        phone_number='$phone_number', 
                        garment_factory_id='$garment_factory_id' 
                    WHERE employee_id='$employee_id'";
            if ($conn->query($sql) === TRUE) {
                echo "Employee updated successfully!";
            } else {
                echo "Error: " . $conn->error;
            }
            break;

        case 'search':
            $sql = "SELECT * FROM employee WHERE employee_id = '$employee_id'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "Employee Details:<br>";
                    echo "ID: " . $row['employee_id'] . "<br>";
                    echo "First Name: " . $row['first_name'] . "<br>";
                    echo "Last Name: " . $row['last_name'] . "<br>";
                    echo "Address: " . $row['address'] . "<br>";
                    echo "Work Hours: " . $row['work_hours'] . "<br>";
                    echo "Salary: " . $row['salary'] . "<br>";
                    echo "Phone Number: " . $row['phone_number'] . "<br>";
                    echo "Garment Factory ID: " . $row['garment_factory_id'] . "<br>";
                }
            } else {
                echo "No employee found with ID: $employee_id";
            }
            break;

        default:
            echo "Invalid action.";
            break;
    }
}

$conn->close();
?>
