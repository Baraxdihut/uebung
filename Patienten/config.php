<?php
$host = "localhost"; 
$user = "rene"; 
$pass = "12345"; 
$dbname = "tblpatienten";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
}
?>
