<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");

// Überprüfen, ob das Formular gesendet wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $anrede = $_POST['anrede'];
    $titel = $_POST['titel'];
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $firma = $_POST['firma'];
    $strasse = $_POST['strasse'];
    $plz = $_POST['plz'];
    $ort = $_POST['ort'];
    $telefonnr1 = $_POST['telefonnr1'];
    $telefonnr2 = $_POST['telefonnr2'];
    $email = $_POST['email'];
    $kundeseit = $_POST['kundeseit'];
    $fax = $_POST['fax'];
    $kommentar = $_POST['kommentar'];

    // Überprüfen der Verbindung
    if ($conn->connect_error) {
        die("Verbindung fehlgeschlagen: " . $conn->connect_error);
    }

    // Vorbereiten der SQL-Einfügeanweisung mit vorbereiteten Anweisungen, um SQL-Injektionen zu vermeiden
    $sql = "INSERT INTO tbl_kunden (FIDAnrede, Titel, Vorname, Nachname, Firma, Strasse, Plz, Ort, Telefonnr, Telefonnr2, Email, Kundeseit, Fax, Kommentar) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Vorbereiten und Ausführen der vorbereiteten Anweisung
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssisssssss", $anrede, $titel, $vorname, $nachname, $firma, $strasse, $plz, $ort, $telefonnr1, $telefonnr2, $email, $kundeseit, $fax, $kommentar);
        if ($stmt->execute()) {
            echo "Neuer Datensatz wurde erfolgreich eingefügt.";
            header("Location: index.php");
        } else {
            echo "Fehler: " . $stmt->error;
        }
        // Schließen des Statements
        $stmt->close();
    } else {
        echo "Fehler bei der Vorbereitung der Anweisung: " . $conn->error;
    }

    // Schließt die Datenbankverbindung
    $conn->close();
}
?>
