<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ticket kaufen</title>
</head>
<body>
    <h2>Ticket kaufen</h2>
    <form action="purchase_ticket.php" method="post">
        <label for="event_id">Event ID:</label>
        <input type="number" id="event_id" name="event_id" required><br><br>
        
        <label for="vorname">Vorname:</label>
        <input type="text" id="vorname" name="vorname" required><br><br>
        
        <label for="nachname">Nachname:</label>
        <input type="text" id="nachname" name="nachname" required><br><br>
        
        <input type="submit" value="Ticket kaufen">
    </form>
</body>
</html>
