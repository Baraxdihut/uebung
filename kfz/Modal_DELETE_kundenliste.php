<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php"); 

 if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
      $kunden_id = $_POST['id'];
    // $kunden_id = 4;


     // Vorbereitung der DELETE-Anweisung
     $stmt = $conn->prepare("DELETE FROM tbl_kunden WHERE IDKunde = ?");

    // Parameter binden
     $stmt->bind_param('i', $kunden_id);

     if ($stmt->execute()) {
         // Erfolgreich gelöscht, Weiterleitung zur Kundenliste
         header("Location: kundenliste.php");
         exit();
     } else {
         // Fehler beim Löschen
         die("Ein Fehler ist aufgetreten: " . $conn->error);
     }
 } else {
     // Falls keine POST-Anfrage oder keine ID vorhanden ist, Weiterleitung zur Indexseite
     header("Location: index.php");
     exit();
 }

?>