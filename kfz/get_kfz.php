<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");

// Kundendaten aus der Anfrage abrufen
$kundeId = $_GET['id'];

// Fahrzeuge des ausgewählten Kunden abrufen
$query = "SELECT IDKfz, Kennzeichen FROM tbl_kfz WHERE FIDKunde = $kundeId";
$result = mysqli_query($conn, $query);

// Ergebnis in ein Array konvertieren
$kundenKFZ = array();
while ($row = mysqli_fetch_assoc($result)) {
    $kundenKFZ[] = $row;
}

// Ergebnis als JSON zurückgeben
echo json_encode($kundenKFZ);

// Verbindung schließen
mysqli_close($conn);
?>
