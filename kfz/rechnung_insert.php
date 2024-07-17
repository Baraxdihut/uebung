<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");


// Überprüfe, ob das Formular gesendet wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kfz = isset($_POST['kfz']) ? $_POST['kfz'] : ''; // Überprüfe, ob das Feld gesetzt ist
    $taetigkeiten = $_POST['taetigkeiten'];
    $rechnungsnummer = $_POST['rechnungsnummer'];
    
    // SQL-Abfrage für das Einfügen der Daten
    $sql = "INSERT INTO tbl_rechnungen (FIDKfz, FIDTaetigkeiten, Rechnungsnummer) VALUES ('$kfz', '$taetigkeiten', '$rechnungsnummer')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Rechnung erfolgreich erstellt";
        header("Location: rechnungsstart.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Schließe die Verbindung zur Datenbank
$conn->close();
?>
