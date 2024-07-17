<?php
require "config.php";

$conn = new mysqli($host, $user, $pass, $dbname);

// Verbindung überprüfen
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM tblpatienten");

?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Alle Patienten</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Alle Patienten</h2>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Vorname</th>
            <th scope="col">Nachname</th>
            <th scope="col">Versicherungsnummer</th>
            <th scope="col">Geburtsdatum</th>
            <th scope="col">Straße</th>
            <th scope="col">Postleitzahl</th>
            <th scope="col">Ort</th>
            <th scope="col">Telefonnummer</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Vorname'] . "</td>";
                echo "<td>" . $row['Nachname'] . "</td>";
                echo "<td>" . $row['Versicherungsnummer'] . "</td>";
                echo "<td>" . $row['Geburtsdatum'] . "</td>";
                echo "<td>" . $row['Straße'] . "</td>";
                echo "<td>" . $row['Postleitzahl'] . "</td>";
                echo "<td>" . $row['Ort'] . "</td>";
                echo "<td>" . $row['Telefonnummer'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>Keine Daten gefunden</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- AJAX-Funktion -->
<script>
    function loadContent(page) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("content").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", page, true);
        xhttp.send();
    }
</script>

</body>
</html>
