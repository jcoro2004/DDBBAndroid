<?php
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

// Check if id_usuari is set
if (isset($_POST['id_usuari'])) {
    $id_usuari = $_POST['id_usuari'];

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE usuaris SET puntuacio = 0 WHERE id_usuari = ?");
    $stmt->bind_param("i", $id_usuari);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Score reset successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "id_usuari not set";
}

// Close the connection
$conn->close();
?>