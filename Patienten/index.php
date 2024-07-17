<?php
require "config.php";
$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
$result = $conn->query("SELECT * FROM tblpatienten");
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <!-- Bootstrap CSS einbinden -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- Navigation mit Bootstrap -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">Meine Website</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadContent('neuer_patient.php')">Neuer Patient</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadContent('patient.php')">Patient</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadContent('alle_patienten_mit_diagnose.php')">Alle Patienten mit Diagnose</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="loadContent('diagnose_zu_patient.php')">Diagnose zu Patient</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Inhalt wird hier geladen -->
<div class="container mt-4" id="content">
</div>

<!-- Bootstrap JS einbinden -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- AJAX-Funktion zum Laden des Inhalts -->
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
