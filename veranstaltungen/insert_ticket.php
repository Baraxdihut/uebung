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
$vorname = $_POST['vorname'];
$nachname = $_POST['nachname'];
$kaufDatum = date('Y-m-d H:i:s');

// Überprüfen, ob noch Tickets verfügbar sind
$sql_check = "SELECT COUNT(*) as ticket_count FROM tbl_tickets WHERE FIDEvents = $event_id";
$result_check = $conn->query($sql_check);
$row_check = $result_check->fetch_assoc();

$sql_max_tickets = "SELECT max_tickets FROM tbl_events WHERE IDEvents = $event_id";
$result_max_tickets = $conn->query($sql_max_tickets);
$row_max_tickets = $result_max_tickets->fetch_assoc();

if ($row_check['ticket_count'] < $row_max_tickets['max_tickets']) {
    $sql = "INSERT INTO tbl_tickets (FIDEvents, Vorname, Nachname, KaufDatum)
    VALUES ($event_id, '$vorname', '$nachname', '$kaufDatum')";

    if ($conn->query($sql) === TRUE) {
        echo "Ticket erfolgreich gekauft";
    } else {
        echo "Fehler: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Keine Tickets mehr verfügbar";
}

$conn->close();
?>
