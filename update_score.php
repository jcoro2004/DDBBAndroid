<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $score = $_POST['score'];

    if (empty($name) || empty($score)) {
        echo json_encode(['success' => false, 'message' => 'Name or score is missing']);
        exit;
    }

    // Conexión a la base de datos
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "pokemon4";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
    }

    // Actualizar la puntuación del usuario
    $stmt = $conn->prepare("UPDATE usuaris SET puntuacio = ? WHERE nom_usuari = ?");
    $stmt->bind_param("is", $score, $name);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Score updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update score']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>