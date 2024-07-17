<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");

if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Filter
$from = isset($_GET['from']) ? $_GET['from'] : '';
$to = isset($_GET['to']) ? $_GET['to'] : '';
$motor = isset($_GET['motor']) ? $_GET['motor'] : '';
$rahmentyp = isset($_GET['rahmentyp']) ? $_GET['rahmentyp'] : '';

$sql = "SELECT tbl_bestellungen.*, 
        tbl_rahmentypen.Bezeichnung AS RahmentypBezeichnung, tbl_rahmentypen.Preis AS RahmentypPreis,
        tbl_farben.Bezeichnung AS FarbeBezeichnung,
        tbl_motoren.Bezeichnung AS MotorBezeichnung, tbl_motoren.Preis AS MotorPreis,
        tbl_bremsen.Bezeichnung AS BremseBezeichnung, tbl_bremsen.Preis AS BremsePreis,
        tbl_beleuchtungen.Bezeichnung AS BeleuchtungBezeichnung, tbl_beleuchtungen.Preis AS BeleuchtungPreis
        FROM tbl_bestellungen
        INNER JOIN tbl_rahmentypen ON tbl_rahmentypen.IDRahmentyp = tbl_bestellungen.FIDRahmentyp
        INNER JOIN tbl_farben ON tbl_farben.IDFarbe = tbl_bestellungen.FIDFarbe
        INNER JOIN tbl_motoren ON tbl_motoren.IDMotor = tbl_bestellungen.FIDMotor
        INNER JOIN tbl_bremsen ON tbl_bremsen.IDBremse = tbl_bestellungen.FIDBremse
        LEFT JOIN tbl_beleuchtungen ON tbl_beleuchtungen.IDBeleuchtung = tbl_bestellungen.FIDBeleuchtung
        WHERE 1=1";

if ($from) {
    $sql .= " AND tbl_bestellungen.DatumBestellung >= '$from'";
}
if ($to) {
    $sql .= " AND tbl_bestellungen.DatumBestellung <= '$to'";
}
if ($motor) {
    $sql .= " AND tbl_bestellungen.FIDMotor = '$motor'";
}
if ($rahmentyp) {
    $sql .= " AND tbl_bestellungen.FIDRahmentyp = '$rahmentyp'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $totalPrice = $row["RahmentypPreis"] + $row["MotorPreis"] + $row["BremsePreis"] + ($row["BeleuchtungPreis"] ?? 0);
        echo "<div>";
        echo "<p>Bestelldatum: " . $row["DatumBestellung"] . "</p>";
        echo "<p>Gesamtpreis: EUR " . number_format($totalPrice, 2) . "</p>";
        echo "<ul>";
        echo "<li>Rahmentyp: " . $row["RahmentypBezeichnung"] . "</li>";
        echo "<li>Farbe: " . $row["FarbeBezeichnung"] . "</li>";  
        echo "<li>Motor: " . $row["MotorBezeichnung"] . "</li>";
        echo "<li>Bremse: " . $row["BremseBezeichnung"] . "</li>";
        echo "<li>Beleuchtung: " . $row["BeleuchtungBezeichnung"] . "</li>";
        echo "</ul>";
        echo "</div>";
    }
} else {
    echo "Keine Bestellungen gefunden.";
}

$conn->close();
?>
