<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");

// Formulardaten verarbeiten und in die Datenbank einfügen
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $spielname = $_POST['spielname'];
    $kategorie = $_POST['kategorie'];
    $zustand = $_POST['zustand'];
    $verfuegbarkeit = $_POST['verfuegbarkeit'];

    $sql = "INSERT INTO Spiele (Spielname, KategorieID, ZustandID, VerfuegbarkeitID) VALUES ('$spielname', '$kategorie', '$zustand', '$verfuegbarkeit')";

    if ($conn->query($sql) === TRUE) {
        // Neues Spiel erfolgreich erfasst, Weiterleitung zur index.php
        header("Location: index.php");
        exit(); // Beenden der aktuellen Skriptausführung, um sicherzustellen, dass die Weiterleitung funktioniert
    } else {
        echo "Fehler beim Erfassen des Spiels: " . $conn->error;
    }
}

$conn->close();
?>
