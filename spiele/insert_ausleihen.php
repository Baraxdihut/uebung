<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");

// Überprüfen, ob Formular gesendet wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Formulardaten validieren und bereinigen
    $kundenID = trim(htmlspecialchars($_POST["kunde"]));
    $spielID = trim(htmlspecialchars($_POST["spiel"]));
    $beginn = trim(htmlspecialchars($_POST["beginn"]));
    $ende = trim(htmlspecialchars($_POST["ende"]));

    // SQL-Query zum Einfügen der Daten in die Ausleihen-Tabelle
    $sql = "INSERT INTO Ausleihen (KundenID, SpielID, Beginn, Ende) 
            VALUES ('$kundenID', '$spielID', '$beginn', '$ende')";

    if ($conn->query($sql) === TRUE) {
    // Ausleihe erfolgreich eingefügt, Weiterleitung zur index.php
    header("Location: index.php");
    exit();
    } else {
        echo "Fehler beim Einfügen der Ausleihe: " . $conn->error;
    }
}

$conn->close();
?>
