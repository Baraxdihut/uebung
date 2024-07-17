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
    <title>KFZliste</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">   
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<!-- NAV-Bar -->
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
<br>
<!-- Aufbau DATATABLE -->
<div class="container">
    <table id="kfzTable" class="table table-striped table-bordered">    
        <thead>
            <tr>
                <th style=>ID-Kfz</th>
                <th style=>Kunde</th>
                <th style=>Kennzeichen</th>
                <th style=>Marke</th>
                <th style=>Karosserieform</th>
                <th style=>Kraftstoff</th>
                <th style=>Baujahr</th>
                <th style=>Kilometerstand</th>
                <th style=>Leistung</th>
                <th style=>Zulassung</th>
                <th style=>Erstzulassung</th>
                <th style=>VIN</th>
                <th style=>Motornummer</th>
                <th style=>Hubraum</th>
                <th style=>Türen</th>
                <th style=>Bearbeiten</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM tbl_kfz";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {

                    $kundeSql = "SELECT * FROM tbl_kunden WHERE IDKunde = " . $row['FIDKunde'];
                    $kundeResult = $conn->query($kundeSql);
                    $kundeData = $kundeResult->fetch_assoc();
                   
                    $markeSql = "SELECT * FROM tbl_marke WHERE IDMarke = " . $row['FIDMarke'];
                    $markeResult = $conn->query($markeSql);
                    $markeData = $markeResult->fetch_assoc();
        
                    $karosserieSql = "SELECT * FROM tbl_karosserieform WHERE IDKarosserieform = " . $row['FIDKarosserieform'];
                    $karosserieResult = $conn->query($karosserieSql);
                    $karosserieData = $karosserieResult->fetch_assoc();

                    $kraftstoffSql = "SELECT * FROM tbl_kraftstoff WHERE IDKraftstoff = " . $row['FIDKraftstoff'];
                    $kraftstoffResult = $conn->query($kraftstoffSql);
                    $kraftstoffData = $kraftstoffResult->fetch_assoc();

                    $tuerenSql = "SELECT * FROM tbl_tueren WHERE IDTueren = " . $row['FIDTueren'];
                    $tuerenResult = $conn->query($tuerenSql);
                    $tuerenData = $tuerenResult->fetch_assoc();

                    echo "<tr>";
                    echo "<td>".$row['IDKfz']."</td>";
                    echo "<td>".$kundeData['Vorname']." ".$kundeData['Nachname']."</td>";
                    echo "<td>".$row['Kennzeichen']."</td>";
                    echo "<td>".$markeData['Marke']."</td>";
                    echo "<td>".$karosserieData['Karosserieform']."</td>";
                    echo "<td>".$kraftstoffData['Kraftstoff']."</td>";                   
                    echo "<td>".$row['Baujahr']."</td>";
                    echo "<td>".$row['Kilometerstand']."</td>";
                    echo "<td>".$row['Leistung']."</td>";
                    echo "<td>".$row['Zulassung']."</td>";
                    echo "<td>".$row['Erstzulassung']."</td>";
                    echo "<td>".$row['VIN']."</td>";
                    echo "<td>".$row['Motornummer']."</td>";
                    echo "<td>".$row['Hubraum']."</td>";
                    echo "<td>".$tuerenData['Anzahl']."</td>";
                    echo "<td>
                    <div class='btn-group'>
                        <button type='button' 
                                class='btn btn-info btn-xs dt-view update_data' 
                                style='margin-right:16px;' 
                                data-bs-toggle='modal' 
                                data-bs-target='#updateData' 
                                id='edit_data' 
                                onclick=\"update_data_function(
                                     {$row['IDKfz']},
                                    '{$kundeData['IDKunde']}',
                                    '{$row['Kennzeichen']}',
                                    '{$markeData['IDMarke']}',
                                    '{$karosserieData['IDKarosserieform']}',
                                    '{$kraftstoffData['IDKraftstoff']}',
                                    '{$row['Baujahr']}',
                                    '{$row['Kilometerstand']}',
                                    '{$row['Leistung']}',
                                    '{$row['Zulassung']}',
                                    '{$row['Erstzulassung']}',
                                    '{$row['VIN']}',
                                    '{$row['Motornummer']}',
                                    '{$row['Hubraum']}',
                                    '{$tuerenData['IDTueren']}'
                                )\">Update</button>
                        <button type='button' 
                                class='btn btn-danger btn-xs BTN_delete' 
                                data-bs-toggle='modal' 
                                data-bs-target='#deleteData_modal' 
                                datatable-id=\"{$row['IDKfz']}\">Löschen</button>
                        </div>
                    </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='14'>Keine Daten gefunden</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- MODAL für Update kfzliste -->
<div class="modal fade" id="updateData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateDataLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="updateDataLabel">Update Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="MODAL_UPDATE_kfzliste.php" method="post" >
                        <div class="modal-body">
                            <div class="col-md-6 mb-3">
                                <label for="id_kfz">KFZ ID:</label>
                                <input type="text" name="id_kfz" id="id_kfz"  class="form-control" placeholder="KFZ ID" readonly>   
                            </div>
                                <!-- Dropdown Vorname  HIER SOLLTE MAN ES VERBINDEN FÜR EINE AUTOMATISCHE AUSWAHL DES NAMENS ANHAND VOM VORNAMEN--> 
                                <div class="form-group mb-3">
                                    <label for="id_kunden_name">Kunde</label>
                                        <select class="form-control" name="kunden_name" id="id_kunden_name">
                                        <option value="">Bitte wählen</option>
                                                    <?php

                                                        $sql_name = "SELECT * FROM tbl_kunden";
                                                        $result_name = $conn->query($sql_name);

                                                        if ($result_name->num_rows > 0) {
                                                            while($row_name = $result_name->fetch_assoc()) {
                                                                echo "<option value=\"" . $row_name['IDKunde'] . "\">" .$row_name['Vorname']." ".$row_name['Nachname']. "</option>";
                                                            }
                                                        } else {
                                                            echo "Keine Ergebnisse gefunden";
                                                        }
                                                    ?>  
                                        </select>
                                        </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_kennzeichen">Kennzeichen</label>
                                    <input type="text" name="kennzeichen" id="id_kennzeichen" class="form-control" placeholder="Kennzeichen" >
                                </div>
                                <!-- Dropdown Marke -->
                                <div class="form-group mb-3">
                                    <label for="id_marke">Marke</label>
                                        <select class="form-control" name="marke" id="id_marke" >
                                            <option value="">Bitte wählen</option>
                                                    <?php
                                                        $sql_marke = "SELECT * FROM tbl_marke";
                                                        $result_marke = $conn->query($sql_marke);

                                                        if ($result_marke->num_rows > 0) {
                                                            while($row_marke = $result_marke->fetch_assoc()) {
                                                                echo "<option value=\"" . $row_marke['IDMarke'] . "\">" . $row_marke['Marke'] . "</option>";
                                                            }
                                                        } else {
                                                            echo "Keine Ergebnisse gefunden";
                                                        }
                                                    ?>
                                        </select>
                                </div>
                                <!-- Dropdown Karosserieform -->
                                <div class="form-group mb-3">
                                    <label for="id_karosserieform">Karosserieform</label>
                                        <select class="form-control" name="karosserieform" id="id_karosserieform" >
                                            <option value="">Bitte wählen</option>
                                                    <?php
                                                        $sql_karosserieform = "SELECT * FROM tbl_karosserieform";
                                                        $result_karosserieform = $conn->query($sql_karosserieform);

                                                        if ($result_karosserieform->num_rows > 0) {
                                                            while($row_karosserieform = $result_karosserieform->fetch_assoc()) {
                                                                echo "<option value=\"" . $row_karosserieform['IDKarosserieform'] . "\">" . $row_karosserieform['Karosserieform'] . "</option>";
                                                            }
                                                        } else {
                                                            echo "Keine Ergebnisse gefunden";
                                                        }
                                                    ?>
                                        </select>
                                </div>
                                <!-- Dropdown Kraftstoff -->
                                <div class="form-group mb-3">
                                    <label for="id_kraftstoff">Kraftstoff</label>
                                        <select class="form-control" name="kraftstoff" id="id_kraftstoff" >
                                            <option value="">Bitte wählen</option>
                                                    <?php
                                                        $sql_kraftstoff = "SELECT * FROM tbl_kraftstoff";
                                                        $result_kraftstoff = $conn->query($sql_kraftstoff);

                                                        if ($result_kraftstoff->num_rows > 0) {
                                                            while($row_kraftstoff = $result_kraftstoff->fetch_assoc()) {
                                                                echo "<option value=\"" . $row_kraftstoff['IDKraftstoff'] . "\">" . $row_kraftstoff['Kraftstoff'] . "</option>";
                                                            }
                                                        } else {
                                                            echo "Keine Ergebnisse gefunden";
                                                        }
                                                    ?>
                                        </select>
                                </div>   
                                <div class="form-group mb-3">
                                    <label for="id_baujahr">Baujahr</label>
                                    <input type="text" name="baujahr" id="id_baujahr" class="form-control" placeholder="Baujahr" >
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_kilometerstand">Kilometerstand</label>
                                    <input type="text" name="kilometerstand" id="id_kilometerstand" class="form-control" placeholder="Kilometerstand" >
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_leistung">Leistung</label>leistung
                                    <input type="text" name="leistung" id="id_leistung" class="form-control" placeholder="Leistung" >
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_zulassung">Zulassung</label>
                                    <input type="date" name="zulassung" id="id_zulassung" class="form-control" placeholder="Zulassung" >
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_erstzulassung">Erstzulassung</label>
                                    <input type="date" name="erstzulassung" id="id_erstzulassung" class="form-control" placeholder="Erstzulassung" >
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_vin_Nummer">VIN Nummer</label>
                                    <input type="text" name="vin_Nummer" id="id_vin_Nummer" class="form-control" placeholder="VIN Nummer" >
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_motornummer">Motornummer</label>
                                    <input type="text" name="motornummer" id="id_motornummer" class="form-control" placeholder="Motornummer" >
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_hubraum">Hubraum</label>
                                    <input type="text" name="hubraum" id="id_hubraum" class="form-control" placeholder="Hubraum" >
                                </div>
                                <!-- Dropdown Türen -->
                                <div class="form-group mb-3">
                                    <label for="id_tueren_anzahl">Türen Anzahl</label>
                                        <select class="form-control" name="tueren_anzahl" id="id_tueren_anzahl" >
                                            <option value="">Bitte wählen</option>
                                                    <?php
                                                        $sql_tueren = "SELECT * FROM tbl_tueren";
                                                        $result_tueren = $conn->query($sql_tueren);

                                                        if ($result_tueren->num_rows > 0) {
                                                            while($row_tueren = $result_tueren->fetch_assoc()) {
                                                                echo "<option value=\"" . $row_tueren['IDTueren'] . "\">" . $row_tueren['Anzahl'] . "</option>";
                                                            }
                                                        } else {
                                                            echo "Keine Ergebnisse gefunden";
                                                        }
                                                        echo $tueren_anzahl;
                                                    ?>
                                        </select>
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
        Sind Sie sicher, soll dieser Eintrag aus Tabelle KFZ wirklich gelöscht werden ?
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

<script>//Aufruf DATATABLE
    $(document).ready(function() {
        $('#kfzTable').DataTable();
    });
</script>

<script> //Function mit Parameter für Wertetausch im INPUT, aus der DB
function update_data_function(id_kfz, kunden_name, kennzeichen, marke, karosserieform, kraftstoff, baujahr, kilometerstand, leistung, zulassung, erstzulassung, vin_Nummer, motornummer, hubraum, tueren_anzahl,) {
  document.getElementById('id_kfz').value = id_kfz;
  document.getElementById('id_kunden_name').value = kunden_name;
  document.getElementById('id_kennzeichen').value = kennzeichen;
  document.getElementById('id_marke').value = marke;
  document.getElementById('id_karosserieform').value = karosserieform;
  document.getElementById('id_kraftstoff').value = kraftstoff;
  document.getElementById('id_baujahr').value = baujahr;
  document.getElementById('id_kilometerstand').value = kilometerstand;
  document.getElementById('id_leistung').value = leistung;
  document.getElementById('id_zulassung').value = zulassung;
  document.getElementById('id_erstzulassung').value = erstzulassung;
  document.getElementById('id_vin_Nummer').value = vin_Nummer;
  document.getElementById('id_motornummer').value = motornummer;
  document.getElementById('id_hubraum').value = hubraum;
  document.getElementById('id_tueren_anzahl').value = tueren_anzahl;  
}
</script>

<script> // Function für das DELETE-MODAL mit einer Bestätigungsfrage
    document.addEventListener("DOMContentLoaded", function() {
  var deleteModal = new bootstrap.Modal(document.getElementById('deleteData_modal'), {
    keyboard: false
  });
  var del_btn_modal = document.getElementById('del_btn_modal');

  document.querySelectorAll('.BTN_delete').forEach(function(button) {
    button.addEventListener('click', function(event) {

      var id = button.getAttribute('datatable-id');
      del_btn_modal.onclick = function() {

        var form = document.createElement('form');
        form.method = 'POST';
        form.action = 'Modal_DELETE_kfzliste.php'; // Pfad zum PHP-Skript, das den Löschvorgang verarbeitet

        var hiddenfield = document.createElement('input');
        hiddenfield.type = 'hidden';
        hiddenfield.name = 'id';
        hiddenfield.value = id;
  
        form.appendChild(hiddenfield);
        document.body.appendChild(form);
        form.submit();
      };
    });
  });
});
</script>
</body>
</html>
