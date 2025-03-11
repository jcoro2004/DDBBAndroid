<?php
header("Content-Type: application/json");

// Connexió a la base de dades
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "pokemon";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(["error" => "Connexió fallida: " . $conn->connect_error]));
}

// Obtenir la llista de taules
$tablesQuery = $conn->query("SHOW TABLES");
$databaseData = [];

if ($tablesQuery) {
    while ($table = $tablesQuery->fetch_array()) {
        $tableName = $table[0];

        // Obtenir totes les dades de cada taula
        $result = $conn->query("SELECT * FROM $tableName");
        $rows = [];

        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }

        $databaseData[$tableName] = $rows;
    }
}

// Retornar les dades en format JSON
echo json_encode($databaseData, JSON_PRETTY_PRINT);
$conn->close();
?>
