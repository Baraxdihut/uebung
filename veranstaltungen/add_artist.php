<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Künstler hinzufügen</title>
</head>
<body>
    <h2>Künstler hinzufügen</h2>
    <form action="add_artist.php" method="post">
    <label for="event_id">Event:</label>
        <select id="event_id" name="event_id" required>
            <option value="">Wählen Sie ein Event</option>
            <?php
            $sql = "SELECT IDEvents, Name FROM tbl_events";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["IDEvents"] . "'>" . $row["Name"] . "</option>";
                }
            } else {
                echo "<option value=''>Keine Events verfügbar</option>";
            }

            $conn->close();
            ?>
         </select><br><br>
         
        <label for="name">Künstler Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="beschreibung">Beschreibung:</label>
        <textarea id="beschreibung" name="beschreibung"></textarea><br><br>
        
        <label for="start_time">Start Zeit:</label>
        <input type="datetime-local" id="start_time" name="start_time" required><br><br>
        
        <label for="end_time">End Zeit:</label>
        <input type="datetime-local" id="end_time" name="end_time" required><br><br>
        
        <input type="submit" value="Künstler hinzufügen">
    </form>
</body>
</html>
