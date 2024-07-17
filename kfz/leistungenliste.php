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
    <title>Leistungen DataTable</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
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
    <h2>Leistungen DataTable</h2>
    <table id="leistungenTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Kunde</th>
                <th>Rechnung</th>
                <th>Konto</th>
                <th>Ersatzteile</th>
                <th>Verkauf</th>
                <th>Menge</th>
                <th>Bezeichnung</th>
                <th>Steuersatz</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $sql = "SELECT * FROM tbl_leistungen";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $kundeSql = "SELECT Vorname, Nachname FROM tbl_kunden WHERE IDKunde = " . $row['FIDKunde'];
                    $kundeResult = $conn->query($kundeSql);
                    $kundeData = $kundeResult->fetch_assoc();

                    $kontoSql = "SELECT Kontobezeichnung FROM tbl_konto WHERE IDKonto = " . $row['FIDKonto'];
                    $kontoResult = $conn->query($kontoSql);
                    $kontoData = $kontoResult->fetch_assoc();

                    $ersatzteileSql = "SELECT Ersatzteilname FROM tbl_ersatzteile WHERE IDErsatzteile = " . $row['FIDErsatzteile'];
                    $ersatzteileResult = $conn->query($ersatzteileSql);
                    $ersatzteileData = $ersatzteileResult->fetch_assoc();

                    echo "<tr>";
                    echo "<td>".$kundeData['FIDKunde']."</td>"; 
                    echo "<td>".$row['FIDRechnungen']."</td>"; 
                    echo "<td>".$kontoData['Kontobezeichnung']."</td>";
                    echo "<td>".$ersatzteileData['Ersatzteilname']."</td>";
                    echo "<td>".$row['Verkauf']."</td>";
                    echo "<td>".$row['Menge']."</td>";
                    echo "<td>".$row['Bezeichnung']."</td>";
                    echo "<td>".$row['Steuersatz']."</td>";
                    echo "<td>
                            <div class='btn-group'>
                                <button type='button' 
                                        class='btn btn-info btn-xs dt-view' 
                                        style='margin-right:16px;' 
                                        data-bs-toggle='modal' 
                                        data-bs-target='#updateData' 
                                        onclick=\"update_data_formular(
                                             {$row['IDLeistung']},
                                            '{$row['FIDRechnung']}',
                                            '{$row['FIDKonto']}',
                                            '{$row['FIDLieferant']}',
                                            '{$row['Einkauf']}',
                                            '{$row['Verkauf']}',
                                            '{$row['Menge']}',
                                            '{$row['Bezeichnung']}',
                                            '{$row['Steuersatz']}',
                                        )\">Update</button>

                                <button type='button' 
                                        class='btn btn-danger btn-xs BTN_delete_datatable' 
                                        data-bs-toggle='modal' 
                                        data-bs-target='#deleteData_modal' 
                                        datatable-id=\"{$row['IDKunde']}\">Löschen</button>

                                <button type='button' 
                                        class='btn btn-danger btn-xs BTN_rechnung_erstellen' 
                                        data-bs-toggle='modal' 
                                        data-bs-target='#rechnungData_modal' 
                                        datatable-id=\"{$row['IDKunde']}\">Rechnungerstellen</button>
                            </div>
                        </td>";
                        echo "</tr>";
                    }
            } else {
                echo "<tr><td colspan='16'>Keine Kunden gefunden</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

</body>
</html>
