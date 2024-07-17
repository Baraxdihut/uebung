<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leistungen hinzufügen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">KFZ</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="kunden.php" >Kunden Erfassen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kfz.php" >KFZ hinzufügen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kundenliste.php" >Kundenliste</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kfzliste.php" >Kfzliste</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="rechnungsstart.php" >Rechnungsformular</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="leistungen.php" >Leistungen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="positionview.php" >Abschluss</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<div class="container">
    <h2>Positionen hinzufügen</h2>
    <form action="leistungen_insert.php" method="POST">
    <div class="row">
    <div class="col-md-6 mb-3">
    <label for="rechnungen">Rechnung:</label>
        <select class="form-control" id="rechnung" name="rechnung">
            <option value="">Bitte wählen</option>
            <?php
            // SQL-Abfrage ausführen
            $sql = "SELECT * FROM tbl_rechnungen";
            $result = $conn->query($sql);

            // Überprüfen, ob die Abfrage erfolgreich war
            if ($result->num_rows > 0) {
                // Daten ausgeben
                while($row = $result->fetch_assoc()) {
                    echo "<option value=\"" . $row['IDRechnungen'] . "\">" . $row['Rechnungsnummer'] . "</option>";
                }
            } else {
                echo "Keine Ergebnisse gefunden";
            }
            ?>
        </select>
    </div>

<div class="col-md-6 mb-3">
    <label for="konto">Konto:</label>
        <select class="form-control" id="konto" name="konto">
            <option value="">Bitte wählen</option>
                <?php
                // SQL-Abfrage ausführen
                $sql = "SELECT * FROM tbl_konto";
                $result = $conn->query($sql);

                // Überprüfen, ob die Abfrage erfolgreich war
                if ($result->num_rows > 0) {
                    // Daten ausgeben
                    while($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row['IDKonto'] . "\">" . $row['Kontobezeichnung'] . "</option>";
                    }
                } else {
                    echo "Keine Ergebnisse gefunden";
                }
                ?>
        </select>
</div>

<div class="col-md-6 mb-3">
    <label for="ersatzteile">Ersatzteil:</label>
        <select class="form-control" id="ersatzteile" name="ersatzteile">
            <option value="">Bitte wählen</option>
                <?php
                // SQL-Abfrage ausführen
                $sql = "SELECT * FROM tbl_ersatzteile";
                $result = $conn->query($sql);

                // Überprüfen, ob die Abfrage erfolgreich war
                if ($result->num_rows > 0) {
                    // Daten ausgeben
                    while($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row['IDErsatzteile'] . "\">" . $row['Ersatzteilname'] . "</option>";
                    }
                } else {
                    echo "Keine Ergebnisse gefunden";
                }
                ?>
        </select>
</div>

<div class="col-md-6 mb-3">
    <label for="Menge">Menge:</label>
    <input type="text" class="form-control" name="Menge">
</div>

<div class="col-md-6 mb-3">
    <label for="Verkauf">Verkauf:</label>
    <input type="text" class="form-control" name="Verkauf">
</div>

<div class="col-md-6 mb-3">
    <label for="status">Status:</label>
    <select class="form-control" id="status" name="status">
                <option value="">Bitte wählen</option>
                <?php
                // SQL-Abfrage ausführen
                $sql = "SELECT * FROM tbl_status";
                $result = $conn->query($sql);

                // Überprüfen, ob die Abfrage erfolgreich war
                if ($result->num_rows > 0) {
                    // Daten ausgeben
                    while($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row['IDStatus'] . "\">" . $row['Statusbezeichnung'] . "</option>";
                    }
                } else {
                    echo "Keine Ergebnisse gefunden";
                }
                ?>
        </select>
</div>

<div class="col-md-6 mb-3">
    <label for="Steuersatz">Steuersatz:</label>
    <input type="text" class="form-control" name="Steuersatz" value="20%">
</div>


<div class="col-md-6 mb-3">
    <label for="Bezeichnung">Bezeichnung:</label>
    <input type="text" class="form-control" name="Bezeichnung">
</div>

 <button type="submit" class="btn btn-primary">Eintragen</button>
</form>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
