<?php
// Datenbankverbindung herstellen
$servername = "your_host";
$username = "your_user";
$password = "your_password";
$dbname = "your_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Daten zum Aktualisieren
$id = 1; // ID des Datensatzes, der aktualisiert werden soll
$new_email = "new.email@example.com";

// Prepared Statement
$stmt = $conn->prepare("UPDATE your_table SET email = ? WHERE id = ?");
$stmt->bind_param("si", $new_email, $id);

if ($stmt->execute()) {
    echo "Record updated successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
