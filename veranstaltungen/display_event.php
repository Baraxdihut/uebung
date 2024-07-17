<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tbl_events";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<h2>Event: " . $row["Name"]. "</h2>";
        echo "<p>Beschreibung: " . $row["Beschreibung"]. "</p>";
        echo "<p>Location: " . $row["Location"]. "</p>";
        echo "<p>Start Datum: " . $row["Start_date"]. "</p>";
        echo "<p>End Datum: " . $row["End_date"]. "</p>";
        echo "<p>Preis: " . $row["Preis"]. "</p>";
        echo "<p>Maximale Tickets: " . $row["max_tickets"]. "</p>";
        if ($row["image_url"]) {
            echo "<img src='" . $row["image_url"] . "' alt='Event Bild' style='max-width:200px;'><br>";
        }

        $event_id = $row["IDEvents"];
        $sql_artists = "SELECT * FROM tbl_artists WHERE FIDEvents = $event_id";
        $result_artists = $conn->query($sql_artists);

        if ($result_artists->num_rows > 0) {
            echo "<h3>Künstler:</h3>";
            while($row_artist = $result_artists->fetch_assoc()) {
                echo "<p>Name: " . $row_artist["Name"]. "</p>";
                echo "<p>Beschreibung: " . $row_artist["Beschreibung"]. "</p>";
                echo "<p>Start Zeit: " . $row_artist["Start_time"]. "</p>";
                echo "<p>End Zeit: " . $row_artist["End_time"]. "</p>";
            }
        } else {
            echo "<p>Keine Künstler für dieses Event gefunden.</p>";
        }
    }
} else {
    echo "Keine Events gefunden";
}

$conn->close();
?>
