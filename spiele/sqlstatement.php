<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<title>SQL-Statements Auflistung</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h1>SQL-Statements Auflistung</h1>

    <ul class="list-group">
        <li class="list-group-item">
            <h2>SQL-Statement für die Anzahl der Spiele, die ein Spieler momentan entliehen hat</h2>
            <code>sql = "SELECT COUNT(*) AS Anzahl
             FROM Ausleihen
             WHERE KundenID = :kundenID AND Ende >= NOW()";</code>
        </li>
        <li class="list-group-item">
            <h2>SQL-Statement für die Anzahl der Spiele, die ein Spieler in Summe entliehen hat</h2>
            <code>$sql = "SELECT COUNT(*) AS Anzahl
             FROM Ausleihen
             WHERE KundenID = :kundenID";</code>
        </li>
        <li class="list-group-item">
            <h2>SQL-Statement für verliehene Spiele nach Häufigkeit</h2>
            <code>$sql = "SELECT SpielID, COUNT(*) AS Anzahl
             FROM Ausleihen
             GROUP BY SpielID
             ORDER BY Anzahl DESC";</code>
        </li>
        <li class="list-group-item">
            <h2>SQL-Statement für Spiele, die noch nie entliehen wurden</h2>
            <code>$sql = "SELECT SpielID, Spielname
             FROM Spiele
             WHERE SpielID NOT IN (SELECT SpielID FROM Ausleihen)";</code>
        </li>
        <li class="list-group-item">
            <h2>SQL-Statement für Spieler, die noch nie entlehnt haben</h2>
            <code>sql1 = "SELECT COUNT(*) AS Anzahl
             FROM Ausleihen
             WHERE KundenID = :kundenID AND Ende >= NOW()";</code>
        </li>
        <li class="list-group-item">
            <h2>SQL-Statement für Spiele, deren Zustand bei der Rückgabe nicht OK war</h2>
            <code>sql1 = "SELECT COUNT(*) AS Anzahl
             FROM Ausleihen
             WHERE KundenID = :kundenID AND Ende >= NOW()";</code>
        </li>
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
