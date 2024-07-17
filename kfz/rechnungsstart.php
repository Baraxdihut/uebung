<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechnung erstellen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">   
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="style.css">
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
<div class="container"> <!-- Formular-->
        <br>
        <h2>Rechnung start</h2>
        <form action="rechnung_insert.php" method="post">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="kunde">Kunde:</label>
                <select class="form-control" name="kunde" id="kunde">
                    <?php
                    // Kundendaten aus der Datenbank abrufen
                    $query = "SELECT IDKunde, Vorname, Nachname FROM tbl_kunden";
                    $result = mysqli_query($conn, $query);

                    // Optionen für das Dropdown-Menü erstellen
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['IDKunde'] . "'>" . $row['Vorname'] . " " . $row['Nachname'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="kfz">KFZ:</label>
                <select class="form-control" name="kfz" id="kfz">
                    <!-- Die Optionen werden dynamisch über JavaScript aktualisiert -->
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label for="taetigkeiten">Tätigkeit:</label>
                <select class="form-control" name="taetigkeiten" id="taetigkeiten">
                    <option value="">Bitte wählen</option>
                    <?php
                    $sql_status = "SELECT * FROM tbl_taetigkeiten";
                    $result_status = $conn->query($sql_status);
                    if ($result_status->num_rows > 0) {
                        while($row = $result_status->fetch_assoc()) {
                            echo "<option value=\"" . $row['IDTaetigkeiten'] . "\">" . $row['Taetigkeiten'] . "</option>";
                        }
                    } else {
                        echo "Keine Ergebnisse gefunden";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label for="rechnungsnummer">Rechnungsnummer:</label>
                <input type="text" class="form-control" id="rechnungsnummer" name="rechnungsnummer" value="<?php echo generateRechnungsnummer(); ?>" readonly>
            </div>

            <input type="submit" class="btn btn-primary" value="Rechnung erstellen">
                </div>
        </form>
</div>
<br>
<br>
<!-- Aufbau Rechnungstable Kundenliste -->
<div class="container">
    <table id="rechnungTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>IDRechnung</th>
                <th>Kundenname</th>
                <th>Kennzeichen</th>
                <th>Tätigkeit</th>
                <th>Rechnungsnummer</th>
                <th>Rechnungsdatum</th>
                <th>Bearbeiten</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT tbl_rechnungen.IDRechnungen, tbl_kfz.Kennzeichen, tbl_kunden.Vorname, tbl_kunden.Nachname, tbl_rechnungen.Rechnungsnummer, tbl_rechnungen.Rechnungsdatum , tbl_taetigkeiten.Taetigkeiten
                FROM tbl_rechnungen
                INNER JOIN tbl_kfz ON tbl_rechnungen.FIDKfz = tbl_kfz.IDKfz
                INNER JOIN tbl_taetigkeiten ON tbl_rechnungen.FIDTaetigkeiten = tbl_taetigkeiten.IDTaetigkeiten
                INNER JOIN tbl_kunden ON tbl_kfz.FIDKunde = tbl_kunden.IDKunde";
                $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    echo "<tr>";
                    echo "<td>"  .$row['IDRechnungen'] . "</td>";
                    echo "<td>"  .$row['Vorname']." ".$row['Nachname']."</td>";
                    echo "<td>" . $row['Kennzeichen'] . "</td>";
                    echo "<td>" . $row['Taetigkeiten'] . "</td>";
                    echo "<td>" . $row['Rechnungsnummer'] . "</td>";
                    echo "<td>" . $row['Rechnungsdatum'] . "</td>";
                    echo "<td>
                            <div class='btn-group'>
                                <button type='button' class='btn btn-info btn-xs dt-view update_data' style='margin-right:16px;' data-bs-toggle='modal' data-bs-target='#updateData' onclick=\"update_data_function(
                                     {$row['IDRechnungen']}
                                    '{$row['Kennzeichen']}',
                                    '{$row['Taetigkeiten']}',
                                    '{$row['Rechnungsnummer']}',
                                    '{$row['Rechnungsdatum']}'
                                )\">Update</button>
                                <button type='button' class='btn btn-danger btn-xs BTN_delete' data-bs-toggle='modal' data-bs-target='#deleteData'>Löschen</button>
                            </div>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>Keine Rechnungen gefunden</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>



<script>// JavaScript, um die Fahrzeuge des ausgewählten Kunden abzurufen
        document.getElementById('kunde').addEventListener('change', function() {
            var kundeId = this.value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_kfz.php?id=' + kundeId, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var kfzOptions = JSON.parse(xhr.responseText);
                    var kfzSelect = document.getElementById('kfz');
                    kfzSelect.innerHTML = '';
                    kfzOptions.forEach(function(option) {
                        var kfzOption = document.createElement('option');
                        kfzOption.text = option.Kennzeichen;
                        kfzOption.value = option.IDKfz;
                        kfzSelect.add(kfzOption);
                    });
                }
            };
            xhr.send();
        });
</script>

<?php //Rechnungsnummer generieren
    function generateRechnungsnummer() {
        global $conn;
        // ID der letzten Rechnung abrufen
        $query = "SELECT MAX(IDRechnungen) AS max_id FROM tbl_rechnungen";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $next_id = $row['max_id'] + 1;

        return 'R-' . $next_id; // Beispiel: R-1, R-2, R-3, ...
    }
?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script> // Function für DATATABLE erstellung
    $(document).ready(function() {
        $('#rechnungTable').DataTable();
    });
</script>

</body>
</html>
