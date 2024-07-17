
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

// Daten zum Löschen
$id = 1; // ID des Datensatzes, der gelöscht werden soll

// Prepared Statement
$stmt = $conn->prepare("DELETE FROM your_table WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Record deleted successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
