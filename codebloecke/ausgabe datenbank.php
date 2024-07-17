<?php
$servername = "your_host";
$username = "your_user";
$password = "your_password";
$dbname = "your_db";

// Verbindung erstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Verbindung überprüfen
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL-Abfrage
$sql = "SELECT id, name, email FROM your_table";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Daten aus jeder Zeile ausgeben
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Name: " . $row["name"] . " - Email: " . $row["email"] . "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>
