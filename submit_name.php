<?php
// submit_name.php

// Database connection details
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "pokemon";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the name is set in the POST request
if (isset($_POST['name'])) {
    $name = $_POST['name'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO usuaris (nom_usuari, puntuacio) VALUES (?, 0)");
    $stmt->bind_param("s", $name);

    // Execute the statement
    if ($stmt->execute()) {
        http_response_code(200);
        echo "Name submitted successfully";
    } else {
        http_response_code(500);
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    http_response_code(400);
    echo "Name not provided";
}

// Close the connection
$conn->close();
?>