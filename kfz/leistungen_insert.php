<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");

// Überprüfen, ob das Formular abgeschickt wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rechnung = $_POST["rechnung"];
    $konto = $_POST["konto"];
    $ersatzteile = $_POST["ersatzteile"];
    $Menge = $_POST["Menge"];
    $Verkauf = $_POST["Verkauf"];
    $status = $_POST["status"];
    $Steuersatz = $_POST["Steuersatz"];
    $Bezeichnung = $_POST["Bezeichnung"];

    // Vorbereiten der SQL-Einfügeanweisung mit vorbereiteten Anweisungen, um SQL-Injektionen zu vermeiden
    $sql = "INSERT INTO tbl_leistungen (FIDRechnungen, FIDKonto, FIDErsatzteile, FIDStatus, Verkauf, Menge, Bezeichnung, Steuersatz) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Vorbereiten und Ausführen der vorbereiteten Anweisung
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("iiiiisss", $rechnung, $konto, $ersatzteile, $status, $Verkauf, $Menge, $Bezeichnung, $Steuersatz);
        if ($stmt->execute()) {
            echo "Daten erfolgreich eingetragen";
            header("Location: leistungenliste.php");
        } else {
            echo "Fehler: " . $stmt->error;
        }
        // Schließen des Statements
        $stmt->close();
    } else {
        echo "Fehler bei der Vorbereitung der Anweisung: " . $conn->error;
    }
}

// Schließt die Datenbankverbindung
$conn->close();
?>
