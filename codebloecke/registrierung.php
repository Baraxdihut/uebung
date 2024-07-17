<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrierung</title>
</head>
<body>

<h2>Registrierung</h2>
<form method="post" action="">
    <label for="username">Benutzername:</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="password">Passwort:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="submit">Registrieren</button>
</form>

</body>
</html>
