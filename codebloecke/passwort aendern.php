<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = trim($_POST['current_password']);
    $new_password = trim($_POST['new_password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Überprüfen, ob die neuen Passwörter übereinstimmen
    if ($new_password !== $confirm_password) {
        echo "Die neuen Passwörter stimmen nicht überein.";
    } else {
        $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        $stmt->close();

        // Überprüfen des aktuellen Passworts
        if (password_verify($current_password, $hashed_password)) {
            // Neues Passwort hashen und speichern
            $new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->bind_param("si", $new_hashed_password, $_SESSION['user_id']);

            if ($stmt->execute()) {
                echo "Das Passwort wurde erfolgreich geändert.";
            } else {
                echo "Fehler: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Das aktuelle Passwort ist falsch.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Passwort ändern</title>
</head>
<body>

<h2>Passwort ändern</h2>
<form method="post" action="">
    <div>
        <label for="current_password">Aktuelles Passwort:</label>
        <input type="password" id="current_password" name="current_password" required>
    </div>
    <div>
        <label for="new_password">Neues Passwort:</label>
        <input type="password" id="new_password" name="new_password" required>
    </div>
    <div>
        <label for="confirm_password">Neues Passwort bestätigen:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
    </div>
    <div>
        <button type="submit">Passwort ändern</button>
    </div>
</form>

</body>
</html>
