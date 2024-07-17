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
    <title>Kundenliste</title>
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
<br>
<!-- Aufbau Datatable Kundenliste -->
    <div class="container">
        <table id="kundenTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Anrede</th>
                    <th>Titel</th>
                    <th>Vorname</th>
                    <th>Nachname</th>
                    <th>Firma</th>
                    <th>Ort</th>
                    <th>PLZ</th>
                    <th>Strasse</th>
                    <th>Telefonnr</th>
                    <th>Telefonnr2</th>
                    <th>Email</th>
                    <th>Kundeseit</th>
                    <th>Fax</th>
                    <th>Kommentar</th>
                    <th>Bearbeiten</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT k.*, a.* FROM tbl_kunden k LEFT JOIN tbl_anreden a ON k.FIDAnrede = a.IDAnrede";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".$row['IDKunde']."</td>";
                    echo "<td>".$row['Anrede']."</td>"; 
                    echo "<td>".$row['Titel']."</td>";
                    echo "<td>".$row['Vorname']."</td>";
                    echo "<td>".$row['Nachname']."</td>";
                    echo "<td>".$row['Firma']."</td>";
                    echo "<td>".$row['Ort']."</td>";
                    echo "<td>".$row['Plz']."</td>";
                    echo "<td>".$row['Strasse']."</td>";
                    echo "<td>".$row['Telefonnr']."</td>";
                    echo "<td>".$row['Telefonnr2']."</td>";
                    echo "<td>".$row['Email']."</td>";
                    echo "<td>".$row['Kundeseit']."</td>";
                    echo "<td>".$row['Fax']."</td>";
                    echo "<td>".$row['Kommentar']."</td>";
                    echo "<td>
                            <div class='btn-group'>
                                <button type='button' 
                                        class='btn btn-info btn-xs dt-view' 
                                        style='margin-right:16px;' 
                                        data-bs-toggle='modal' 
                                        data-bs-target='#updateData' 
                                        onclick=\"update_data_formular(
                                             {$row['IDKunde']},
                                            '{$row['IDAnrede']}',
                                            '{$row['Titel']}',
                                            '{$row['Vorname']}',
                                            '{$row['Nachname']}',
                                            '{$row['Firma']}',
                                            '{$row['Ort']}',
                                            '{$row['Plz']}',
                                            '{$row['Strasse']}',
                                            '{$row['Telefonnr']}',
                                            '{$row['Telefonnr2']}',
                                            '{$row['Email']}',
                                            '{$row['Kundeseit']}',
                                            '{$row['Fax']}',
                                            '{$row['Kommentar']}'
                                        )\">Update</button>
                                <button type='button' 
                                        class='btn btn-danger btn-xs BTN_delete_datatable' 
                                        data-bs-toggle='modal' 
                                        data-bs-target='#deleteData_modal' 
                                        datatable-id=\"{$row['IDKunde']}\">Löschen</button>
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



    <!-- Modal für Update Kundenliste.php -->
<div class="modal fade" id="updateData" name="upd_data" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateDataLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="updateDataLabel">Update Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="Modal_UPDATE_kundenliste.php" method="post" >
        <div class="modal-body">
            <div>
                <label for="id_kunde">Kunden ID:</label>
                <input type="text" name="id_kunde" id="id_kunde" readonly>   
            </div>

                <div class="col-md-6 mb-3">
                    <label for="id_anrede">Anrede:</label>
                    <select class="form-control" name="anrede" id="id_anrede" >
                        <option value="">Bitte wählen</option>
                        <?php
                        $sql_anrede = "SELECT * FROM tbl_anreden";
                        $result_anrede = $conn->query($sql_anrede);

                        if ($result_anrede->num_rows > 0) {
                            while($row = $result_anrede->fetch_assoc()) {
                                echo "<option value=\"" . $row['IDAnrede'] . "\">" . $row['Anrede'] . "</option>";
                            }
                        } else {
                            echo "Keine Ergebnisse gefunden";
                        }
                        $conn->close();
                        ?>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="id_titel">Titel</label>
                    <input type="text" name="titel" id="id_titel" class="form-control" placeholder="Titel" >
                </div>
                <div class="form-group mb-3">
                    <label for="id_vorname">Vorname</label>
                    <input type="text" name="vorname" id="id_vorname" class="form-control" placeholder="Vorname" >
                </div>
                <div class="form-group mb-3">
                    <label for="id_nachname">Nachname</label>
                    <input type="text" name="nachname" id="id_nachname" class="form-control" placeholder="Nachname" >
                </div>
                <div class="form-group mb-3">
                    <label for="id_firma">Firma</label>
                    <input type="text" name="firma" id="id_firma" class="form-control" placeholder="Firma" >
                </div>
                <div class="form-group mb-3">
                    <label for="id_ort">Ort</label>
                    <input type="text" name="ort" id="id_ort" class="form-control" placeholder="Ort" >
                </div>
                <div class="form-group mb-3">
                    <label for="id_plz">Postleitzahl</label>
                    <input type="text" name="plz" id="id_plz" class="form-control" placeholder="PLZ" >
                </div>
                <div class="form-group mb-3">
                    <label for="id_strasse">Strasse</label>
                    <input type="text" name="strasse" id="id_strasse" class="form-control" placeholder="Strasse" >
                </div>
                <div class="form-group mb-3">
                    <label for="id_telefonnr">Telefonnr</label>
                    <input type="text" name="telefonnr" id="id_telefonnr" class="form-control" placeholder="Telefonnr" >
                </div>
                <div class="form-group mb-3">
                    <label for="id_telefonnr2">Telefonnr2</label>
                    <input type="text" name="telefonnr2" id="id_telefonnr2" class="form-control" placeholder="Telefonnr2" >
                </div>
                <div class="form-group mb-3">
                    <label for="id_email">Email</label>
                    <input type="email" name="email" id="id_email" class="form-control" placeholder="Email" >
                </div>
                <div class="form-group mb-3">
                    <label for="id_kundenseit">Kundeseit</label>
                    <input type="text" name="kundenseit" id="id_kundenseit" class="form-control" placeholder="Kundeseit" >
                </div>
                <div class="form-group mb-3">
                    <label for="id_fax">FAX</label>
                    <input type="text" name="fax" id="id_fax" class="form-control" placeholder="FAX" >
                </div>
                <div class="form-group mb-3">
                    <label for="id_kommentar">Kommentar</label>
                    <input type="text" name="kommentar" id="id_kommentar" class="form-control" placeholder="Kommentar" >
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
        Sind Sie sicher, soll dieser Eintrag aus der Tabelle Kunden wirklich gelöscht werden ?
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

<script> // Function für DATATABLE erstellung
    $(document).ready(function() {
        $('#kundenTable').DataTable();
    });
</script>

<script> //Function mit Parameter für die ANzeige der Daten aus der DB, Kunden-Tabelle mit Hilfe von ID und NAMEN aus dem MODAL Formular
function update_data_formular(id_kunde, anrede, titel, vorname, nachname, firma, ort, plz, strasse, telefonnr, telefonnr2, email, kundenseit, fax, kommentar,) 
{
  document.getElementById('id_kunde').value = id_kunde;
  document.getElementById('id_anrede').value = anrede;
  document.getElementById('id_titel').value = titel;
  document.getElementById('id_vorname').value = vorname;
  document.getElementById('id_nachname').value = nachname;
  document.getElementById('id_firma').value = firma;
  document.getElementById('id_ort').value = ort;
  document.getElementById('id_plz').value = plz;
  document.getElementById('id_strasse').value = strasse;
  document.getElementById('id_telefonnr').value = telefonnr;
  document.getElementById('id_telefonnr2').value = telefonnr2;
  document.getElementById('id_email').value = email;
  document.getElementById('id_kundenseit').value = kundenseit;
  document.getElementById('id_fax').value = fax;
  document.getElementById('id_kommentar').value = kommentar;
}
</script>

<script> // Function für das DELETE-MODAL mit einer Bestätigungsfrage
    document.addEventListener("DOMContentLoaded", function() {
  var deleteModal = new bootstrap.Modal(document.getElementById('deleteData_modal'), {
    keyboard: false
  });
  var del_btn_modal = document.getElementById('del_btn_modal');

  document.querySelectorAll('.BTN_delete_datatable').forEach(function(button) {
    button.addEventListener('click', function(event) {

      var id = button.getAttribute('datatable-id');
      del_btn_modal.onclick = function() {

        var form = document.createElement('form');
        form.method = 'POST';
        form.action = 'Modal_DELETE_kundenliste.php'; // Pfad zum PHP-Skript, das den Löschvorgang verarbeitet

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
