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

$sql = "SELECT id_usuari, nom_usuari, puntuacio FROM usuaris ORDER BY puntuacio DESC";
$result = $conn->query($sql);

$users = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
} else {
    echo "0 results";
}
$conn->close();

// Return the data in JSON format
header('Content-Type: application/json');
echo json_encode($users);
?>