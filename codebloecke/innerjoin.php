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

// SQL-Abfrage mit INNER JOIN
$sql = "
    SELECT users.id, users.name, users.email, orders.order_id, orders.product, orders.amount
    FROM users
    INNER JOIN orders ON users.id = orders.user_id
    WHERE users.id = ?
";

$user_id = 1; // Beispiel-ID des Benutzers

// Prepared Statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Daten aus jeder Zeile ausgeben
    while($row = $result->fetch_assoc()) {
        echo "User ID: " . $row["id"] . " - Name: " . $row["name"] . " - Email: " . $row["email"] . "<br>";
        echo "Order ID: " . $row["order_id"] . " - Product: " . $row["product"] . " - Amount: " . $row["amount"] . "<br><br>";
    }
} else {
    echo "0 results";
}

$stmt->close();
$conn->close();
?>
