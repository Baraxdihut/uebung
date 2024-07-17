<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");

// Überprüfen, ob das Formular gesendet wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fidkunde = $_POST['fidkunde'];
    $kennzeichen = $_POST['kennzeichen'];
    $fidmarke = $_POST['fidmarke'];
    $fidkarosserieform = $_POST['fidkarosserieform'];
    $fidkraftstoff = $_POST['fidkraftstoff'];
    $fidtueren = $_POST['fidtueren'];
    $baujahr = $_POST['baujahr'];
    $kilometerstand = $_POST['kilometerstand'];
    $leistung = $_POST['leistung'];
    $zulassung = $_POST['zulassung'];
    $erstzulassung = $_POST['erstzulassung'];
    $vin = $_POST['vin'];
    $motornummer = $_POST['motornummer'];
    $hubraum = $_POST['hubraum'];

    // Vorbereiten der SQL-Einfügeanweisung
    $sql = "INSERT INTO tbl_kfz (FIDKunde, Kennzeichen, FIDMarke, FIDKarosserieform, FIDKraftstoff, FIDTueren, Baujahr, Kilometerstand, Leistung, Zulassung, Erstzulassung, VIN, Motornummer, Hubraum) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Vorbereiten und Ausführen der vorbereiteten Anweisung
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("isiiiiisssssss", $fidkunde, $kennzeichen, $fidmarke, $fidkarosserieform, $fidkraftstoff, $fidtueren, $baujahr, $kilometerstand, $leistung, $zulassung, $erstzulassung, $vin, $motornummer, $hubraum);
        if ($stmt->execute()) {
            echo "Neuer Datensatz wurde erfolgreich eingefügt.";
            header("Location: kfzliste.php");
        } else {
            echo "Fehler: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Fehler bei der Vorbereitung der Anweisung: " . $conn->error;
    }

    $conn->close();
}
?>
