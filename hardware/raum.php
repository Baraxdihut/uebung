<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function displayRoomsAndComputers($conn) {
    echo "<h1>Räume & Computer</h1>";
    $sql = "SELECT tbl_raeume.Raumbezeichnung, tbl_computer.IDComputer, tbl_computer.Bezeichnung, tbl_computer.Installationszeitpunkt, 
                   tbl_hersteller.Hersteller, tbl_betriebssysteme.Betriebssystem, tbl_versionen.Version
            FROM tbl_raeume
            LEFT JOIN tbl_computer ON tbl_raeume.IDRaum = tbl_computer.FIDRaum
            LEFT JOIN tbl_hersteller ON tbl_computer.FIDHersteller = tbl_hersteller.IDHersteller
            LEFT JOIN tbl_betriebssystem_version ON tbl_computer.FIDBetriebssystemVersion = tbl_betriebssystem_version.IDBetriebssystemVersion
            LEFT JOIN tbl_betriebssysteme ON tbl_betriebssystem_version.FIDBetriebssystem = tbl_betriebssysteme.IDBetriebssystem
            LEFT JOIN tbl_versionen ON tbl_betriebssystem_version.FIDVersion = tbl_versionen.IDVersion
            ORDER BY tbl_raeume.Raumbezeichnung, tbl_computer.Bezeichnung";
    
    $result = $conn->query($sql);

    $currentRoom = null;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row['Raumbezeichnung'] != $currentRoom) {
                if ($currentRoom !== null) {
                    echo "</ul>";
                }
                $currentRoom = $row['Raumbezeichnung'];
                echo "<h2>$currentRoom</h2><ul>";
            }
            if ($row['IDComputer']) {
                echo "<li>{$row['Bezeichnung']} (Hersteller: {$row['Hersteller']}, OS: {$row['Betriebssystem']} {$row['Version']}, Installiert am: {$row['Installationszeitpunkt']})</li>";
            } else {
                echo "<li>leerer Raum</li>";
            }
        }
        echo "</ul>";
    } else {
        echo "Keine Daten gefunden.";
    }
}

function displayUnusedComputers($conn) {
    echo "<h2>aktuell unbenutzte Computer</h2>";
    $sql = "SELECT tbl_computer.IDComputer, tbl_computer.Bezeichnung, tbl_computer.Installationszeitpunkt, tbl_hersteller.Hersteller, 
                   tbl_betriebssysteme.Betriebssystem, tbl_versionen.Version
            FROM tbl_computer
            LEFT JOIN tbl_hersteller ON tbl_computer.FIDHersteller = tbl_hersteller.IDHersteller
            LEFT JOIN tbl_betriebssystem_version ON tbl_computer.FIDBetriebssystemVersion = tbl_betriebssystem_version.IDBetriebssystemVersion
            LEFT JOIN tbl_betriebssysteme ON tbl_betriebssystem_version.FIDBetriebssystem = tbl_betriebssysteme.IDBetriebssystem
            LEFT JOIN tbl_versionen ON tbl_betriebssystem_version.FIDVersion = tbl_versionen.IDVersion
            WHERE tbl_computer.FIDRaum IS NULL
            ORDER BY tbl_computer.Bezeichnung";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            echo "<li>{$row['Bezeichnung']} (Hersteller: {$row['Hersteller']}, OS: {$row['Betriebssystem']} {$row['Version']}, Installiert am: {$row['Installationszeitpunkt']})</li>";
        }
        echo "</ul>";
    } else {
        echo "Keine unbenutzten Computer gefunden.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Räume & Computer</title>
</head>
<body>

<?php
displayRoomsAndComputers($conn);
displayUnusedComputers($conn);
?>

</body>
</html>

<?php
$conn->close();
?>
