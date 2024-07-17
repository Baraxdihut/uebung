<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Daten vom Formular
$event_id = $_POST['event_id'];
$name = $_POST['name'];
$beschreibung = $_POST['beschreibung'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];

$sql = "INSERT INTO tbl_artists (FIDEvents, Name, Beschreibung, Start_time, End_time)
VALUES ($event_id, '$name', '$beschreibung', '$start_time', '$end_time')";

if ($conn->query($sql) === TRUE) {
    echo "Neuer Künstler erfolgreich hinzugefügt";
} else {
    echo "Fehler: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
