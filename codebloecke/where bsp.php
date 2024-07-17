<?php
$servername = "your_host";
$username = "your_user";
$password = "your_password";
$dbname = "your_db";

// Verbindung zur Datenbank herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Verbindung überprüfen
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Beispiel-Daten zum Filtern
$age = 25;
$city = 'Berlin';

// SQL-Abfrage mit WHERE-Klausel
$sql = "SELECT * FROM users WHERE age > ? AND city = ?";

// Prepared Statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $age, $city); // "i" für Integer, "s" für String
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Daten aus jeder Zeile ausgeben
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"] . " - Name: " . $row["name"] . " - Email: " . $row["email"] . "<br>";
    }
} else {
    echo "0 results";
}

$stmt->close();
$conn->close();
?>
