<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Daten vom Formular
$name = $_POST['name'];
$beschreibung = $_POST['beschreibung'];
$location = $_POST['location'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$preis = $_POST['preis'];
$max_tickets = $_POST['max_tickets'];

// Bild hochladen
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
$image_url = $target_file;

$sql = "INSERT INTO tbl_events (Name, Beschreibung, Location, Start_date, End_date, Preis, max_tickets, image_url)
VALUES ('$name', '$beschreibung', '$location', '$start_date', '$end_date', $preis, $max_tickets, '$image_url')";

if ($conn->query($sql) === TRUE) {
    echo "Neues Event erfolgreich erstellt";
} else {
    echo "Fehler: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
