<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");

if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produktkonfiguration</title>
    <style>
        .form-group {
            margin-bottom: 15px;
            display: none;
        }
        .form-group select {
            width: 100%;
            padding: 5px;
        }
        .visible {
            display: block;
        }
    </style>
</head>
<body>
<nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="konfigurator.php">Konfigurator</a></li>
            <li><a href="filter.php">Bestellübersicht</a></li>
        </ul>
    </nav>
    <form method = "post" action="insert_konfigurator.php">>
        <div class="form-group visible" id="rahmentyp-group">
            <label for="rahmentyp">Bitte wählen Sie einen Rahmentypen:</label>
            <select class="form-control" id="rahmentyp" name="rahmentyp" onchange="updateSelection('rahmentyp', 'farbe-group')">
                <option value="">Bitte wählen</option>
                <?php
                $sql = "SELECT IDRahmentyp, Bezeichnung FROM tbl_rahmentypen";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row['IDRahmentyp'] . "\">" . $row['Bezeichnung'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Keine Rahmentypen gefunden</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group" id="farbe-group">
            <label for="farbe">Bitte wählen Sie eine Farbe:</label>
            <select class="form-control" id="farbe" name="farbe" onchange="updateSelection('farbe', 'motor-group')">
                <option value="">Bitte wählen</option>
                <?php
                $sql = "SELECT IDFarbe, Bezeichnung FROM tbl_farben";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row['IDFarbe'] . "\">" . $row['Bezeichnung'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Keine Farben gefunden</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group" id="motor-group">
            <label for="motor">Bitte wählen Sie einen Motor:</label>
            <select class="form-control" id="motor" name="motor" onchange="updateSelection('motor', 'bremssystem-group')">
                <option value="">Bitte wählen</option>
                <?php
                $sql = "SELECT IDMotor, Bezeichnung FROM tbl_motoren";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row['IDMotor'] . "\">" . $row['Bezeichnung'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Keine Motoren gefunden</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group" id="bremssystem-group">
            <label for="bremssystem">Bitte wählen Sie ein Bremssystem:</label>
            <select class="form-control" id="bremssystem" name="bremssystem" onchange="updateSelection('bremssystem', 'beleuchtung-group')">
                <option value="">Bitte wählen</option>
                <?php
                $sql = "SELECT IDBremse, Bezeichnung FROM tbl_bremsen";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row['IDBremse'] . "\">" . $row['Bezeichnung'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Keine Bremssysteme gefunden</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group" id="beleuchtung-group">
            <label for="beleuchtung">Bitte wählen Sie ggf. eine Beleuchtung:</label>
            <select class="form-control" id="beleuchtung" name="beleuchtung">
                <option value="">Bitte wählen</option>
                <?php
                $sql = "SELECT IDBeleuchtung, Bezeichnung FROM tbl_beleuchtungen";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row['IDBeleuchtung'] . "\">" . $row['Bezeichnung'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Keine Beleuchtung gefunden</option>";
                }
                ?>
            </select>
        </div>
        
        <div class="form-group visible" id="kontakt">
        <div class="col-md-6 mb-3">
                <label for="Nachname" class="form-label">Nachname:</label>
                <input type="text" class="form-control" id="Nachname" name="Nachname">
            </div>
            <div class="col-md-6 mb-3">
                <label for="Vorname" class="form-label">Vorname:</label>
                <input type="text" class="form-control" id="Vorname" name="Vorname">
        </div>
        <div class="col-md-6 mb-3">
                <label for="Email" class="form-label">Email:</label>
                <input type="text" class="form-control" id="Email" name="Email">
        </div>
        <div class="col-md-6 mb-3">
                <label for="Adresse" class="form-label">Adresse:</label>
                <input type="text" class="form-control" id="Adresse" name="Adresse">
        </div>
        <div class="col-md-6 mb-3">
                <label for="PLZ" class="form-label">PLZ:</label>
                <input type="text" class="form-control" id="PLZ" name="PLZ">
        </div>
        <div class="col-md-6 mb-3">
                <label for="Ort" class="form-label">Ort:</label>
                <input type="text" class="form-control" id="Ort" name="Ort">
        </div>
        <div class="col-md-6 mb-3">
                <label for="Staat" class="form-label">Staat:</label>
                <select class="form-control" id="Staat" name="Staat">
                <option value="">Bitte wählen</option>
                <?php
                $sql = "SELECT IDStaat, Bezeichnung FROM tbl_staaten";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row['IDStaat'] . "\">" . $row['Bezeichnung'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Keine Beleuchtung gefunden</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-6 mb-3">
                <label for="Geburtstag" class="form-label">Geburtstag:</label>
                <input type="date" class="form-control" id="Geburtstag" name="Geburtstag">
        </div>
        </div>
        <button type="submit">Bestellen</button>
    </form>

    <script>
        function updateSelection(currentId, nextGroupId) {
            var currentSelect = document.getElementById(currentId);
            if (currentSelect.value !== "") {
                document.getElementById(nextGroupId).classList.add('visible');
            }
        }
    </script>
</body>
</html>
