<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");

$sql_rechnungen = "SELECT IDRechnungen FROM tbl_rechnungen";
$result_rechnungen = $conn->query($sql_rechnungen);
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leistungen und Ersatzteile für Rechnung</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>
<body><!-- Navbar -->
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
<!-- Kunde Kennzeichen Datum -->

<div class="container mt-5">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label for="rechnung_id">Rechnungs-ID auswählen:</label>
            <select class="form-control" name="rechnung_id" id="rechnung_id">
                <option value="">Bitte wählen</option>
                <?php
                // Optionen für Dropdown-Liste ausgeben
                if ($result_rechnungen->num_rows > 0) {
                    while ($row_rechnungen = $result_rechnungen->fetch_assoc()) {
                        echo "<option value='".$row_rechnungen["IDRechnungen"]."'>".$row_rechnungen["IDRechnungen"]."</option>";
                    }
                } else {
                    echo "<option value=''>Keine Rechnungen gefunden</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Leistungen und Ersatzteile anzeigen</button>
    </form>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["rechnung_id"])) {
        $rechnungs_id = $_POST["rechnung_id"];

        // SQL-Abfrage
        $sql = "SELECT tbl_kunden.Vorname, tbl_kunden.Nachname, tbl_kunden.Strasse, tbl_kunden.Ort, tbl_kunden.Plz,tbl_rechnungen.Rechnungsnummer, tbl_rechnungen.Rechnungsdatum,tbl_leistungen.Verkauf, tbl_leistungen.Menge, tbl_ersatzteile.Ersatzteilname FROM tbl_rechnungen
            INNER JOIN tbl_leistungen ON tbl_rechnungen.IDRechnungen = tbl_leistungen.FIDRechnungen
            INNER JOIN tbl_kfz ON tbl_rechnungen.FIDKfz = tbl_kfz.IDKfz
            INNER JOIN tbl_kunden ON tbl_kfz.FIDKunde = tbl_kunden.IDKunde
            LEFT JOIN tbl_ersatzteile ON tbl_leistungen.FIDErsatzteile = tbl_ersatzteile.IDErsatzteile
            WHERE tbl_rechnungen.IDRechnungen = ?;";

        // Vorbereiten der SQL-Anweisung
        $stmt = $conn->prepare($sql);

        // Binden der Rechnungs-ID als Parameter
        $stmt->bind_param("i", $rechnungs_id);

        // Ausführen der Abfrage
        $stmt->execute();
        $result = $stmt->get_result();

        // Überprüfen, ob Ergebnisse vorhanden sind
        if ($result->num_rows > 0) {
            echo "<div class='row'>";

            // Durchlaufen der Ergebnisse
            while ($row = $result->fetch_assoc()) {
                // Kundendaten ausgeben
                echo "<div class='col-md-6'>";
                echo "<div class='first-container'>";
                echo "<h2 class='mb-4'>Kundendaten</h2>";
                echo "<p>" . $row["Vorname"] . " " . $row["Nachname"] . "</p>";
                echo "<p>" . $row["Strasse"] . "</p>";
                echo "<p>" . $row["Ort"] . "</p>";
                echo "<p>". $row["Plz"] . "</p>";
                echo "</div>";
                echo "</div>";

                // Heutiges Datum generieren
                $heutiges_datum = date("Y-m-d");

                // Rechnungsinformationen ausgeben
                echo "<div class='col-md-6'>";
                echo "<div class='second-container'>";
                echo "<h2 class='mb-4'>Rechnungsinformationen</h2>";
                echo "<p>Rechnungsnummer: " . $row["Rechnungsnummer"] . "</p>";
                echo "<p>Rechnungsdatum: " . $row["Rechnungsdatum"] . "</p>";
                echo "<p>Abschluss Datum: " . $heutiges_datum . "</p>";
                echo "</div>";
                echo "</div>";


                // Leistungen und Ersatzteile ausgeben
                echo "<div class='col-md-12'>";
                echo "<h2 class='mb-4'>Leistungen und Ersatzteile für Rechnung ".$rechnungs_id."</h2>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped'>";
                echo "<thead><tr><th>Ersatzteilname</th><th>Verkauf</th><th>Menge</th><th>Gesamtpreis</th></tr></thead>";
                echo "<tbody>";

                // Gesamtpreis initialisieren
                $gesamtpreis = 0;

                // Durchlaufen der Leistungen und Ersatzteile
                do {
                    // Berechnen des Gesamtpreises pro Position
                    $gesamtposition = $row["Verkauf"] * $row["Menge"];
                    $gesamtpreis += $gesamtposition;

                    // Einzelne Position ausgeben
                    echo "<tr>";
                    echo "<td>".$row["Ersatzteilname"]."</td>";
                    echo "<td>".$row["Verkauf"]."</td>";
                    echo "<td>".$row["Menge"]."</td>";
                    echo "<td>".$gesamtposition."</td>";
                    echo "</tr>";
                } while ($row = $result->fetch_assoc());

                echo "</tbody></table></div>";
                // Durchgehender Strich
                echo "<hr>";
                // Gesamtsumme des Gesamtpreises
                $gesamtsteuer = $gesamtpreis * 0.20;
                $gesamtpreis_inkl_steuer = $gesamtpreis + $gesamtsteuer;
                echo "<table class='table'>";
                echo "<tr><th>Gesamtsumme:</th><td>".$gesamtpreis."</td></tr>";
                echo "<tr><th>Steuersatz:</th><td>".$gesamtsteuer."</td></tr>";
                echo "<tr><th>inkl. Gesamtsumme:</th><td>".$gesamtpreis_inkl_steuer."</td></tr>";
                echo "</table>";
                echo "</div>";
            }
            echo "</div>";
        } else {
            echo "Keine Ergebnisse gefunden für die angegebene Rechnungs-ID";
        }

        // Schließen des Statements
        $stmt->close();
    } else {
        echo "Bitte eine Rechnungs-ID auswählen";
    }
}
?>

</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

</body>
</html>

<?php
// Verbindung schließen
$conn->close();
?>
