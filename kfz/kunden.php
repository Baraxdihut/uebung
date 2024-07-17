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
    <title>Kundenformular</title>
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
            <form method="post" action="kunden_insert.php">
            <div class="row">
                <div class="col-md-6 mb-3">
                <label for="anrede">Anrede:</label>
                    <select class="form-control" id="anrede" name="anrede">
                        <option value="">Bitte wählen</option>
                        <?php
                        // SQL-Abfrage ausführen
                        $sql = "SELECT * FROM tbl_anreden";
                        $result = $conn->query($sql);

                        // Überprüfen, ob die Abfrage erfolgreich war
                        if ($result->num_rows > 0) {
                            // Daten ausgeben
                            while($row = $result->fetch_assoc()) {
                                echo "<option value=\"" . $row['IDAnrede'] . "\">" . $row['Anrede'] . "</option>";
                            }
                        } else {
                            echo "Keine Ergebnisse gefunden";
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="titel">Titel:</label>
                    <input type="text" class="form-control" id="titel" name="titel">
                </div>
            <div class="col-md-6 mb-3">
                <label for="vorname">Vorname:</label>
                <input type="text" class="form-control" id="vorname" name="vorname">
            </div>

            <div class="col-md-6 mb-3">
                <label for="nachname">Nachname:</label>
                <input type="text" class="form-control" id="nachname" name="nachname">
            </div>

            <div class="col-md-6 mb-3">
                <label for="firma">Firma:</label>
                <input type="text" class="form-control" id="firma" name="firma">
            </div>

            <div class="col-md-6 mb-3">
                <label for="strasse">Straße:</label>
                <input type="text" class="form-control" id="strasse" name="strasse">
            </div>

            <div class="col-md-6 mb-3">
                <label for="plz">PLZ:</label>
                <input type="text" class="form-control" id="plz" name="plz">
            </div>

            <div class="col-md-6 mb-3">
                <label for="ort">Ort:</label>
                <input type="text" class="form-control" id="ort" name="ort">
            </div>

            <div class="col-md-6 mb-3">
                <label for="telefonnr1">Telefonnr:</label>
                <input type="text" class="form-control" id="telefonnr1" name="telefonnr1">
            </div>

            <div class="col-md-6 mb-3">
                <label for="telefonnr2">Telefonnr2:</label>
                <input type="text" class="form-control" id="telefonnr2" name="telefonnr2">
            </div>

            <div class="col-md-6 mb-3">
                <label for="email">E-Mail:</label>
                <input type="text" class="form-control" id="email" name="email">
            </div>

            <div class="col-md-6 mb-3">
                <label for="kundeseit">Kunde seit:</label>
                <input type="date" class="form-control" id="kundeseit" name="kundeseit">
            </div>

            <div class="col-md-6 mb-3">
                <label for="fax">Fax:</label>
                <input type="text" class="form-control" id="fax" name="fax">
            </div>

            <div class="col-md-6 mb-3">
                <label for="kommentar">Kommentar:</label>
                <textarea class="form-control" id="kommentar" name="kommentar"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Absenden</button>
        </form>
    </div>
                    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
