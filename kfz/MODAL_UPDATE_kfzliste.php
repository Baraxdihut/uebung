<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");

// Hier kommen die Daten aus dem MODAL-Formular und werden in ein ARRAY gepackt um anschließend mit UPDATE-Anweisung in die DB übertragen zu werden
if (isset($_POST['id_kfz'])) {

    $kfz_id = isset($_POST['id_kfz']) ? (INT)$_POST['id_kfz'] : '';
    //DROPDOWN Kunde
    $kunden_vorname = isset($_POST['kunden_name']) ? (INT)$_POST['kunden_name'] : '';
    $kennzeichen = isset($_POST['kennzeichen']) ? $_POST['kennzeichen'] : '';
    //DROPDOWN Marke
    $marke = isset($_POST['marke']) ? $_POST['marke'] : '';
    //DROPDOWN Karoserieform
    $karosserieform = isset($_POST['karosserieform']) ? $_POST['karosserieform'] : '';
    //DROPDOWN Kraftstoff
    $kraftstoff = isset($_POST['kraftstoff']) ? $_POST['kraftstoff'] : ''; 
    $baujahr = isset($_POST['baujahr']) ? (INT)$_POST['baujahr'] : '';
    $kilometerstand = isset($_POST['kilometerstand']) ? (INT)$_POST['kilometerstand'] : '';
    $leistung = isset($_POST['leistung']) ? (INT)$_POST['leistung'] : '';
    $zulassung = isset($_POST['zulassung']) ? $_POST['zulassung'] : '';
    $erstzulassung = isset($_POST['erstzulassung']) ? $_POST['erstzulassung'] : '';
    $vin_Nummer = isset($_POST['vin_Nummer']) ? $_POST['vin_Nummer'] : '';
    $motornummer = isset($_POST['motornummer']) ? $_POST['motornummer'] : '';
    $hubraum = isset($_POST['hubraum']) ? (INT)$_POST['hubraum'] : '';
    //DROPDOWN Türen
    $tueren_anzahl = isset($_POST['tueren_anzahl']) ? (INT)$_POST['tueren_anzahl'] : '';  

    //Array für Daten
    $update_fields = array();

    //Werte vom MODAL-Formular in die Arrays packen mit den Feldnamen der DB z.b. IDKfz = ...;
    if (!empty($kfz_id)) {
        $update_fields[] = "IDKfz = '$kfz_id'";
        $update_fields[] = "Kennzeichen = '$kennzeichen'";
        $update_fields[] = "Baujahr = '$baujahr'";
        $update_fields[] = "Kilometerstand = '$kilometerstand'";
        $update_fields[] = "Leistung = '$leistung'";
        $update_fields[] = "Zulassung = '$zulassung'";
        $update_fields[] = "Erstzulassung = '$erstzulassung'";
        $update_fields[] = "VIN = '$vin_Nummer'";
        $update_fields[] = "Motornummer = '$motornummer'";
        $update_fields[] = "Hubraum = '$hubraum'";
    }

    //DROPDOWN Kunde
    if (!empty($kunden_name)) {
        $update_fields[] = "FIDKunde = '$kunden_name'";
    }

    //DROPDOWN Marke
    if (!empty($marke)) {
        $update_fields[] = "FIDMarke = '$marke'";
    }

    //DROPDOWN Karosserieform
    if (!empty($karosserieform)) {
        $update_fields[] = "FIDKarosserieform = '$karosserieform'";
    }

    //DROPDOWN Kraftstoff
    if (!empty($kraftstoff)) {
        $update_fields[] = "FIDKraftstoff = '$kraftstoff'";
    }

    //DROPDOWN Türen
    if (!empty($tueren_anzahl)) {
        $update_fields[] = "FIDTueren = '$tueren_anzahl'";
    }
    echo('$update_fields[]');
    if (!empty($update_fields)) {
        $update_query = "UPDATE tbl_kfz SET " . implode(", ", $update_fields) . " WHERE IDKfz = ?";

        $stmt = $conn->prepare($update_query);
        $stmt->bind_param('i', $kfz_id);

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: kfzliste.php");
            exit; // Nach dem Umleiten beenden
        } else {
            echo "Fehler beim Aktualisieren: " . $conn->error;
        }
    } else {
        echo "Keine Daten für ein Update.";
    }
    // Umleitung nach erfolgreicher Aktualisierung
    header("Location: kfzliste.php");
    exit; // Nach dem Umleiten beenden
}
?>
