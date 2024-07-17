<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Event hinzufügen</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Date</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="add_event.php">Datum einfügen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_artist.php">Datumsliste</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="display_event.php">Wochentage</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="buy_ticket.php">Wochentage</a>
                </li>

            </ul>
        </div>
    </div>
</nav>

    <h2>Event hinzufügen</h2>
    <form action="insert_event.php" method="post" enctype="multipart/form-data">
        <label for="name">Event Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="beschreibung">Beschreibung:</label>
        <textarea id="beschreibung" name="beschreibung"></textarea><br><br>
        
        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br><br>
        
        <label for="start_date">Start Datum:</label>
        <input type="date" id="start_date" name="start_date" required><br><br>
        
        <label for="end_date">End Datum:</label>
        <input type="date" id="end_date" name="end_date" required><br><br>
        
        <label for="preis">Preis:</label>
        <input type="number" step="0.01" id="preis" name="preis" required><br><br>

        <label for="max_tickets">Maximale Tickets:</label>
        <input type="number" id="max_tickets" name="max_tickets" required><br><br>
        
        <label for="image">Bild hochladen:</label>
        <input type="file" id="image" name="image" accept="image/*"><br><br>
        
        <input type="submit" value="Event hinzufügen">
    </form>
</body>
</html>
