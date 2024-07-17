<?
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

// Prepared Statement
$stmt = $conn->prepare('SELECT * FROM your_table WHERE your_column = ?');
$stmt->bind_param('s', $filtered_data);
$stmt->execute();
$result = $stmt->get_result();

$results = [];
while ($row = $result->fetch_assoc()) {
    $results[] = $row;
}

$stmt->close();
$conn->close();
