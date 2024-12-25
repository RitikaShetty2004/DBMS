<?php
session_start();
if (!isset($_SESSION['owner_logged_in']) || $_SESSION['owner_logged_in'] !== true) {
    header("Location: login.html"); // Redirect to login if not authenticated
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: white;
            background-image: url('https://images.unsplash.com/photo-1610891015188-5369212db097?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTl8fGdhcm1lbnQlMjBmYWN0b3J5fGVufDB8fDB8fHww');
             background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex; 
            justify-content: center; 
            align-items: center; 
            height: 100vh; 
        }
        header {
            position: absolute;
            top: 0;
            width: 100%;
            background-color: #99b8d7;
            color: rgb(30, 12, 12);
            padding: 10px 0;
            text-align: center;
        }

        .button-container {
            display: flex;
            flex-direction: column; 
            align-items: center;
            margin-top: 100px; 
        }

        .button-container button {
            padding: 15px 30px;
            font-size: 16px;
            background-color: #9abae2;
            color: black;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin: 20px 0px; 
            transition: background-color 0.3s;
        }

        .button-container button:hover {
            background-color: #45a049;
        }
        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 0 auto;
        }
        label {
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .go-back-button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color: #2980b9;
            color:black;
            margin-top: 20px; 
            transition: background-color 0.3s ease;
        }

        .go-back-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Owner Dashboard</h1>
    </header>

    <section>
        <div class="button-container">
            <button onclick="navigate('garment_factory.html')">Garment Factory details</button>
            <button onclick="navigate('employee.html')">Employee details</button>
            <button onclick="navigate('producer.html')">Producer details</button>
            <button onclick="navigate('distributer.html')">Distributer details</button>
            <button onclick="navigate('shipment.html')">Shipment details</button>
            <button onclick="navigate('store.html')">Store details</button>
        </div>
        <button onclick="window.location.href='login.html'">Go Back</button>
    </section>

    <script>
        function navigate(page) {
            window.location.href = page;
        }
    </script>
</body>
</html>
