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

// Daten zum Einfügen
$name = "John Doe";
$email = "john.doe@example.com";

// Prepared Statement
$stmt = $conn->prepare("INSERT INTO your_table (name, email) VALUES (?, ?)");
$stmt->bind_param("ss", $name, $email);

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
