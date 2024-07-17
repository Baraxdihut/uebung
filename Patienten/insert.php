<?php
require "config.php";

if (isset($_POST['submit'])) {
    $vorname = $_POST['Vorname'];
    $nachnahme = $_POST['Nachnahme'];
    $versicherungsnummer = $_POST['Versicherungsnummer'];
    $geburtsdatum = $_POST['Geburtsdatum'];
    $straße = $_POST['Straße'];
    $postleitzahl = $_POST['Postleitzahl'];
    $ort = $_POST['Ort'];
    $telefonnummer = $_POST['Telefonnummer'];

    $insert = $conn->prepare("INSERT INTO tblpatienten (Vorname, Nachnahme, Versicherungsnummer, Geburtsdatum, Straße, Postleitzahl, Ort, Telefonnummer) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $insert->bind_param("ssssssss", $vorname, $nachnahme, $versicherungsnummer, $geburtsdatum, $straße, $postleitzahl, $ort, $telefonnummer);

    $insert->execute();

    if ($insert->affected_rows > 0) {
        echo "Datensatz erfolgreich eingefügt.";
    } else {
        echo "Fehler beim Einfügen des Datensatzes.";
    }

    $insert->close();
}
?>
