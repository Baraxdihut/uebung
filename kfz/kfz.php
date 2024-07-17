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
    <title>KFZ-Formular</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
        <br>
        <br>
        <form method="post" action="kfz_insert.php">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="fidkunde" class="form-label">Kunde:</label>
                <select class="form-control" id="fidkunde" name="fidkunde">
                    <option value="">Bitte wählen</option>
                    <?php
                    // SQL-Abfrage für Kunden ausführen
                    $sql = "SELECT IDKunde, Vorname, Nachname FROM tbl_kunden";
                    $result = $conn->query($sql);

                    // Überprüfen, ob die Abfrage erfolgreich war
                    if ($result->num_rows > 0) {
                        // Daten ausgeben
                        while($row = $result->fetch_assoc()) {
                            echo "<option value=\"" . $row['IDKunde'] . "\">" . $row['Vorname'] . " " . $row['Nachname'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Keine Kunden gefunden</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="kennzeichen" class="form-label">Kennzeichen:</label>
                <input type="text" class="form-control" id="kennzeichen" name="kennzeichen">
            </div>

            <div class="col-md-6 mb-3">
                <label for="fidmarke" class="form-label">Marke:</label>
                <select class="form-control" id="fidmarke" name="fidmarke">
                    <option value="">Bitte wählen</option>
                    <?php
                    // SQL-Abfrage für Marken ausführen
                    $sql = "SELECT IDMarke, Marke FROM tbl_marke";
                    $result = $conn->query($sql);

                    // Überprüfen, ob die Abfrage erfolgreich war
                    if ($result->num_rows > 0) {
                        // Daten ausgeben
                        while($row = $result->fetch_assoc()) {
                            // Marke als Option im Dropdown-Menü anzeigen
                            echo "<option value=\"" . $row['IDMarke'] . "\">" . $row['Marke'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>Keine Marken gefunden</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="fidkarosserieform" class="form-label">Karosserieform:</label>
                    <select class="form-control" id="fidkarosserieform" name="fidkarosserieform">
                        <option value="">Bitte wählen</option>
                        <?php
                        // SQL-Abfrage für Karosserie ausführen
                        $sql = "SELECT IDKarosserieform, Karosserieform FROM tbl_karosserieform";
                        $result = $conn->query($sql);

                        // Überprüfen, ob die Abfrage erfolgreich war
                        if ($result->num_rows > 0) {
                            // Daten ausgeben
                            while($row = $result->fetch_assoc()) {
                                // Marke als Option im Dropdown-Menü anzeigen
                                echo "<option value=\"" . $row['IDKarosserieform'] . "\">" . $row['Karosserieform'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Keine Marken gefunden</option>";
                        }
                        ?>
                    </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="fidkraftstoff" class="form-label">Kraftstoff:</label>
                <select class="form-control" id="fidkraftstoff" name="fidkraftstoff">
                        <option value="">Bitte wählen</option>
                        <?php
                        // SQL-Abfrage für Kraftstoff ausführen
                        $sql = "SELECT IDKraftstoff, Kraftstoff FROM tbl_kraftstoff";
                        $result = $conn->query($sql);

                        // Überprüfen, ob die Abfrage erfolgreich war
                        if ($result->num_rows > 0) {
                            // Daten ausgeben
                            while($row = $result->fetch_assoc()) {
                                // Marke als Option im Dropdown-Menü anzeigen
                                echo "<option value=\"" . $row['IDKraftstoff'] . "\">" . $row['Kraftstoff'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Keine Kraftstoff gefunden</option>";
                        }
                        ?>
                    </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="fidtueren" class="form-label">Türen:</label>
                <select class="form-control" id="fidtueren" name="fidtueren">
                        <option value="">Bitte wählen</option>
                        <?php
                        // SQL-Abfrage für Tueren ausführen
                        $sql = "SELECT IDTueren, Anzahl FROM tbl_tueren";
                        $result = $conn->query($sql);

                        // Überprüfen, ob die Abfrage erfolgreich war
                        if ($result->num_rows > 0) {
                            // Daten ausgeben
                            while($row = $result->fetch_assoc()) {
                                // Marke als Option im Dropdown-Menü anzeigen
                                echo "<option value=\"" . $row['IDTueren'] . "\">" . $row['Anzahl'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Keine Kraftstoff gefunden</option>";
                        }
                        ?>
                    </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="baujahr" class="form-label">Baujahr:</label>
                <input type="text" class="form-control" id="baujahr" name="baujahr">
            </div>

            <div class="col-md-6 mb-3">
                <label for="kilometerstand" class="form-label">Kilometerstand:</label>
                <input type="text" class="form-control" id="kilometerstand" name="kilometerstand">
            </div>

            <div class="col-md-6 mb-3">
                <label for="leistung" class="form-label">Leistung:kw</label>
                <input type="text" class="form-control" id="leistung" name="leistung">
            </div>

            <div class="col-md-6 mb-3">
                <label for="hubraum" class="form-label">Hubraum:</label>
                <input type="text" class="form-control" id="hubraum" name="hubraum">
            </div>

            <div class="col-md-6 mb-3">
                <label for="zulassung" class="form-label">Zulassung:</label>
                <input type="date" class="form-control" id="zulassung" name="zulassung">
            </div>

            <div class="col-md-6 mb-3">
                <label for="erstzulassung" class="form-label">Erstzulassung:</label>
                <input type="date" class="form-control" id="erstzulassung" name="erstzulassung">
            </div>

            <div class="col-md-6 mb-3">
                <label for="vin" class="form-label">VIN:</label>
                <input type="text" class="form-control" id="vin" name="vin">
            </div>
            <div class="col-md-6 mb-3">
                <label for="motornummer" class="form-label">Motornummer:</label>
                <input type="text" class="form-control" id="motornummer" name="motornummer">
            </div>
            <button type="submit" class="btn btn-primary">Datensatz einfügen</button>
        </form>
    </div>
                    </div>
</body>
</html>
