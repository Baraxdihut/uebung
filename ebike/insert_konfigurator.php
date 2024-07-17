<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");

if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rahmentyp = $_POST['rahmentyp'];
    $farbe = $_POST['farbe'];
    $motor = $_POST['motor'];
    $bremssystem = $_POST['bremssystem'];
    $beleuchtung = $_POST['beleuchtung'];
    $nachname = $_POST['Nachname'];
    $vorname = $_POST['Vorname'];
    $email = $_POST['Email'];
    $adresse = $_POST['Adresse'];
    $plz = $_POST['PLZ'];
    $ort = $_POST['Ort'];
    $staat = $_POST['Staat'];
    $geburtstag = $_POST['Geburtstag'];


    // Insert tbl_kunden
    $sql_kunde = "INSERT INTO tbl_kunden (Nachname, Vorname, GebDatum, Adresse, PLZ, Ort, FIDStaat, Emailadresse) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_kunde = $conn->prepare($sql_kunde);
    $stmt_kunde->bind_param("sssssiis", $nachname, $vorname, $geburtstag, $adresse, $plz, $ort, $staat, $email);
    $stmt_kunde->execute();
    $kunde_id = $stmt_kunde->insert_id;
    $stmt_kunde->close();

    // Insert tbl_bestellungen
    $sql_bestellung = "INSERT INTO tbl_bestellungen (FIDKunde, FIDRahmentyp, FIDFarbe, FIDMotor, FIDBremse, FIDBeleuchtung, DatumBestellung) 
                       VALUES (?, ?, ?, ?, ?, ?, NOW())";
    $stmt_bestellung = $conn->prepare($sql_bestellung);
    $stmt_bestellung->bind_param("iiiiii", $kunde_id, $rahmentyp, $farbe, $motor, $bremssystem, $beleuchtung);
    $stmt_bestellung->execute();
    $stmt_bestellung->close();
    header("Location: konfigurator.php");
    echo "Bestellung erfolgreich gespeichert!";
    exit();
}
?>
