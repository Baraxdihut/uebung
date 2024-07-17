<?
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = filterInput($_POST['name']);
    $email = filterInput($_POST['email']);

    // Datenbankverbindung
    $servername = "your_host";
    $username = "your_user";
    $password = "your_password";
    $dbname = "your_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare('INSERT INTO your_table (name, email) VALUES (?, ?)');
    $stmt->bind_param('ss', $name, $email);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
