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
                        <a class="nav-link" href="positionen.php" >Positionen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="positionview.php" >Abschluss</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<div class="container"> <!-- Formular -->
    <h2>Positionen hinzufügen</h2>
        <form action="leistungen_insert.php" method="POST">
            <div class="row">

                <div class="col-md-6 mb-3">
                    <label for="id_rechnung">Rechnungsnummer:</label>
                        <select class="form-control" id="id_rechnung" name="rechnung">
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
                    <label for="verkauf">Verkauf:</label>
                    <input type="text" class="form-control" id="verkauf" name="verkauf">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="menge">Menge:</label>
                    <input type="text" class="form-control" id="menge" name="menge">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="bezeichnung">Bezeichnung:</label>
                    <input type="text" class="form-control" id="bezeichnung" name="bezeichnung">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="steuersatz">Steuersatz:</label>
                    <input type="text" class="form-control" id="steuersatz" name="steuersatz" value="20%" readonly >
                </div>

                <button type="submit" class="btn btn-primary">Eintragen</button>
            </div>
        </form>
    </div>
</div>

<div class="container"> <!-- Aufbau Leistungstable Leistungsliste-->
    <h2>Positionen DataTable</h2>
    <table id="leistungenTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID-Leistungen</th>
                <th>Rechnungsnummer</th>
                <th>Konto</th>
                <th>Ersatzteile</th>
                <th>Status</th>
                <th>Verkauf</th>
                <th>Menge</th>              
                <th>Bezeichnung</th>
                <th>Steuersatz</th>
                <th>Bearbeiten</th> 
            </tr>
        </thead>
        <tbody>
        <?php
            $sql = "SELECT * FROM tbl_leistungen";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    
                    $rechnungenSql = "SELECT IDRechnungen, Rechnungsnummer FROM tbl_rechnungen WHERE IDRechnungen = " . $row['FIDRechnungen'];
                    $rechnungenResult = $conn->query($rechnungenSql);
                    $rechnungenData = $rechnungenResult->fetch_assoc();
                    
                    $kontoSql = "SELECT IDKonto, Kontobezeichnung FROM tbl_konto WHERE IDKonto = " . $row['FIDKonto'];
                    $kontoResult = $conn->query($kontoSql);
                    $kontoData = $kontoResult->fetch_assoc();
                    
                    $ersatzteileSql = "SELECT IDErsatzteile, Ersatzteilname FROM tbl_ersatzteile WHERE IDErsatzteile = " . $row['FIDErsatzteile'];
                    $ersatzteileResult = $conn->query($ersatzteileSql);
                    $ersatzteileData = $ersatzteileResult->fetch_assoc();
                    
                    $statusSql = "SELECT * FROM tbl_status WHERE IDStatus = " . $row['FIDStatus'];
                    $statusResult = $conn->query($statusSql);
                    $statusData = $statusResult->fetch_assoc();
                    
                    echo "<tr>";
                    echo "<td>".$row['IDLeistungen']."</td>"; 
                    echo "<td>".$rechnungenData['Rechnungsnummer']."</td>"; 
                    echo "<td>".$kontoData['Kontobezeichnung']."</td>";
                    echo "<td>".$ersatzteileData['Ersatzteilname']."</td>";
                    echo "<td>".$statusData['Statusbezeichnung']."</td>";
                    echo "<td>".$row['Verkauf']."</td>";
                    echo "<td>".$row['Menge']."</td>";
                    echo "<td>".$row['Bezeichnung']."</td>";
                    echo "<td>".$row['Steuersatz']."</td>";
                    echo "<td>
                            <div class='btn-group'>
                                <button type='button' 
                                        class='btn btn-info btn-xs dt-view update_data' 
                                        style='margin-right:16px;' 
                                        data-bs-toggle='modal' 
                                        data-bs-target='#updateData' 
                                        onclick=\"update_data_function(
                                             {$row['IDLeistungen']},
                                            '{$rechnungenData['FIDRechnungen']}',
                                            '{$kontoData['FIDKonto']}',
                                            '{$ersatzteileData['FIDErsatzteile']}',
                                            '{$statusData['FIDStatus']}',
                                            '{$row['Verkauf']}',
                                            '{$row['Menge']}',
                                            '{$row['Bezeichnung']}',
                                            '{$row['Steuersatz']}'
                                        )\">Update</button>
                                <button type='button' 
                                        class='btn btn-danger btn-xs BTN_delete_datatable'
                                        style='margin-right:16px;' 
                                        data-bs-toggle='modal' 
                                        data-bs-target='#deleteData_modal' 
                                        datatable-id=\"{$row['IDLeistungen']}\">Löschen</button>
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

    <!-- Modal für Update rechnungsstart.php -->
<div class="modal fade" id="updateData" name="upd_data" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateDataLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="updateDataLabel">Update Data</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>           
            <form action="leistungen_insert.php" method="POST">
                    <div class="modal-body">
                        <div class="col-md-6 mb-3">
                            <label for="leistungen">ID Leistungen:</label>
                            <input type="text" class="form-control" id="leistungen" name="leistungen" readonly>
                        </div>
                        <div class="col-md-6 mb-3">    
                        <label for="id_rechnung">Rechnungsnummer:</label>
                            <select class="form-control" id="id_rechnung" name="rechnung" readonly>
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
                            <label for="verkauf">Verkauf:</label>
                            <input type="text" class="form-control" id="verkauf" name="verkauf">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="menge">Menge:</label>
                            <input type="text" class="form-control" id="menge" name="menge">
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="bezeichnung">Bezeichnung:</label>
                            <input type="text" class="form-control" id="bezeichnung" name="bezeichnung">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="steuersatz">Steuersatz:</label>
                            <input type="text" class="form-control" id="steuersatz" name="steuersatz" value="20%" readonly >
                        </div>                       
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="update_data" class="btn btn-primary">Update</button>
                    </div>
            </form>
    </div>
  </div>
</div>

<!-- Modal für Delete Kundenliste.php -->
<div class="modal fade" id="deleteData_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteData_modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="deleteData_modalLabel">Eintrag löschen</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Sind Sie sicher, soll dieser Eintrag aus der Tabelle Rechnungen wirklich gelöscht werden ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="del_btn_modal" >Delete</button>
      </div>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script> //Function mit Parameter für Wertetausch im INPUTFELD, aus der DB
function update_data_function(IDLeistungen, Rechnungsnummer, Kontobezeichnung, Ersatzteilname, Statusbezeichnung, Verkauf, Menge, Bezeichnung, Steuersatz,) 
{
  document.getElementById('leistungen').value = IDLeistungen;
  document.getElementById('id_rechnung').value = Rechnungsnummer;
  document.getElementById('konto').value = Kontobezeichnung;
  document.getElementById('ersatzteile').value = Ersatzteilname;
  document.getElementById('status').value = Statusbezeichnung;
  document.getElementById('verkauf').value = Verkauf;  
  document.getElementById('menge').value = Menge;  
  document.getElementById('bezeichnung').value = Bezeichnung;
  document.getElementById('steuersatz').value = Steuersatz;  
}
</script>

<script> // Function für DATATABLE erstellung
    $(document).ready(function() {
        $('#leistungenTable').DataTable();
    });
</script>
</body>
</html>
