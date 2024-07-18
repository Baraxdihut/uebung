<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all rooms
$sql_rooms = "SELECT IDRaum, Raumbezeichnung FROM tbl_raeume ORDER BY Raumbezeichnung";
$result_rooms = $conn->query($sql_rooms);

$rooms = [];
while ($row = $result_rooms->fetch_assoc()) {
    $rooms[$row['IDRaum']] = $row['Raumbezeichnung'];
}

// Fetch all computers with details
$sql_computers = "
SELECT 
    tbl_computer.Bezeichnung,
    tbl_computer.IDComputer,
    tbl_computer.Installationszeitpunkt,
    tbl_raeume.Raumbezeichnung,
    tbl_raeume.IDRaum,
    tbl_hersteller.Hersteller,
    tbl_betriebssysteme.Betriebssystem,
    tbl_versionen.Version
FROM tbl_computer
LEFT JOIN tbl_raeume ON tbl_computer.FIDRaum = tbl_raeume.IDRaum
LEFT JOIN tbl_hersteller ON tbl_computer.FIDHersteller = tbl_hersteller.IDHersteller
LEFT JOIN tbl_betriebssystem_version ON tbl_computer.FIDBetriebssystemVersion = tbl_betriebssystem_version.IDBetriebssystemVersion
LEFT JOIN tbl_betriebssysteme ON tbl_betriebssystem_version.FIDBetriebssystem = tbl_betriebssysteme.IDBetriebssystem
LEFT JOIN tbl_versionen ON tbl_betriebssystem_version.FIDVersion = tbl_versionen.IDVersion
ORDER BY tbl_raeume.Raumbezeichnung, tbl_computer.Bezeichnung";

$result_computers = $conn->query($sql_computers);

$computers = [];
while ($row = $result_computers->fetch_assoc()) {
    $computers[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Räume & Computer</title>
    <style>
        .navbar {
            text-align: center;
            margin-bottom: 20px;
        }
        .navbar a {
            margin: 0 15px;
            text-decoration: none;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="raeume_computer.php">Räume & Computer</a>
        <a href="hersteller.php">Hersteller</a>
    </div>
    <h2>Räume & Computer</h2>
    <ul>
    <?php
    foreach ($rooms as $room_id => $room_name) {
        echo "<li class='room-title'>" . ($room_name ? $room_name : "Leerer Raum") . "<ul>";

        $room_has_computers = false;
        foreach ($computers as $computer) {
            if ($computer['IDRaum'] == $room_id) {
                echo "<li>{$computer['Bezeichnung']} ({$computer['Hersteller']}) installiert am {$computer['Installationszeitpunkt']} mit {$computer['Betriebssystem']} Version {$computer['Version']}</li>";
                $room_has_computers = true;
            }
        }

        if (!$room_has_computers) {
            echo "<li>Leerer Raum</li>";
        }

        echo "</ul></li>";
    }
    ?>

    <h2> aktuell unbelegte Computer </h2>
    <li class='room-title'>
        <ul>
        <?php
        $unbelegte_computers = false;
        foreach ($computers as $computer) {
            if (empty($computer['Raumbezeichnung'])) {
                echo "<li>{$computer['Bezeichnung']} ({$computer['Hersteller']}) installiert am {$computer['Installationszeitpunkt']} mit {$computer['Betriebssystem']} Version {$computer['Version']}</li>";
                $unbelegte_computers = true;
            }
        }
        if (!$unbelegte_computers) {
            echo "<li>Keine unbelegten Computer</li>";
        }
        ?>
        </ul>
    </li>
    </ul>
</body>
</html>
