<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");
// Hier kommen die Daten aus dem MODAL-Formular und werden in ein ARRAY gepackt um anschließend mit UPDATE-Anweisung in die DB übertragen zu werden
if (isset($_POST['id_kunde'])) {
    
    $kunde_id = isset($_POST['id_kunde']) ? (int)$_POST['id_kunde'] : '';
    $anrede = isset($_POST['anrede']) ? (int)$_POST['anrede'] : '';
    $titel = isset($_POST['titel']) ? $_POST['titel'] : '';
    $vorname = isset($_POST['vorname']) ? $_POST['vorname'] : '';
    $nachname = isset($_POST['nachname']) ? $_POST['nachname'] : '';
    $firma = isset($_POST['firma']) ? $_POST['firma'] : '';
    $ort = isset($_POST['ort']) ? $_POST['ort'] : '';
    $plz = isset($_POST['plz']) ? $_POST['plz'] : '';
    $strasse = isset($_POST['strasse']) ? $_POST['strasse'] : '';
    $telefonnr = isset($_POST['telefonnr']) ? $_POST['telefonnr'] : '';
    $telefonnr2 = isset($_POST['telefonnr2']) ? $_POST['telefonnr2'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $kundeseit = isset($_POST['kundenseit']) ? $_POST['kundenseit'] : '';
    $fax = isset($_POST['fax']) ? $_POST['fax'] : '';
    $kommentar = isset($_POST['kommentar']) ? $_POST['kommentar'] : '';

    // Die zu aktualisierenden Felder und ihre Werte in das Array
    $update_fields = array();
    if (!empty($anrede)) {
        $update_fields[] = "FIDAnrede = '$anrede'";
    }
    if (!empty($titel)) {
        $update_fields[] = "Titel = '$titel'";
    }
    if (!empty($vorname)) {
        $update_fields[] = "Vorname = '$vorname'";
    }
    if (!empty($nachname)) {
        $update_fields[] = "Nachname = '$nachname'";
    }
    if (!empty($firma)) {
        $update_fields[] = "Firma = '$firma'";
    }
    if (!empty($ort)) {
        $update_fields[] = "Ort = '$ort'";
    }
    if (!empty($plz)) {
        $update_fields[] = "Plz = '$plz'";
    }
    if (!empty($strasse)) {
        $update_fields[] = "Strasse = '$strasse'";
    }
    if (!empty($telefonnr)) {
        $update_fields[] = "Telefonnr = '$telefonnr'";
    }
    if (!empty($telefonnr2)) {
        $update_fields[] = "Telefonnr2 = '$telefonnr2'";
    }
    if (!empty($email)) {
        $update_fields[] = "Email = '$email'";
    }
    if (!empty($kundeseit)) {
        $update_fields[] = "Kundeseit = '$kundeseit'";
    }
    if (!empty($fax)) {
        $update_fields[] = "Fax = '$fax'";
    }
    if (!empty($kommentar)) {
        $update_fields[] = "Kommentar = '$kommentar'";
    }

    if (!empty($update_fields)) {
        $update_query = "UPDATE tbl_kunden SET " . implode(", ", $update_fields) . " WHERE IDKunde = ?";
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('i', $kunde_id);

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: kundenliste.php");
            exit; // Nach dem Umleiten beenden
        } else {
            echo "Fehler beim Aktualisieren: " . $conn->error;
        }
    } else {
        echo "Keine Daten für ein Update.";
    }
}
