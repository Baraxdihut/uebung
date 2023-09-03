<?php
require('includes/config.inc.php');
require('includes/common.inc.php');
require('includes/conn.inc.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Einladungen</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="index.php">Startseite</a></li>
                <li><a href="termin_user.php">Termin je User</a></li>
                <li><a href="termine.php">Alle Termine</a></li>
                <li><a href="einladungen.php">Termine nach Einladungsstatus</a></li>
            </ul>
        </nav>

        <h1>Einladungen</h1>

        <?php
            $sql = '
                SELECT 
                    tbl_termine.*,
                    tbl_staaten.Bezeichnung as staatBez,
                    tbl_kategorien.Bezeichnung as KatBez,
                    tbl_user.Nickname
                FROM tbl_termine_einladungen
                INNER JOIN tbl_termine ON tbl_termine.IDTermin=tbl_termine_einladungen.FIDTermin
                INNER JOIN tbl_user ON tbl_user.IDUser=tbl_termine_einladungen.FIDUser
                INNER JOIN tbl_staaten ON tbl_staaten.IDStaat=tbl_termine.FIDStaat
                INNER JOIN tbl_kategorien ON tbl_kategorien.IDKategorie=tbl_termine.FIDKategorie
            ';

            $termine = $conn->query($sql)or die('Fehler in der Query: ' . $conn->error . '<br>' . $sql);

            echo('
                <section>
            ');

            while($termin = $termine->fetch_object()){
                echo('
                    <article class="' . $termin->KatBez . '">
                    <div class="right">' . $termin->Nickname . '</div>
                    <p class="date">von ' . date('d.m.Y h:i', strtotime($termin->Beginn)) . ' Uhr bis ' . date('d.m.Y h:i', strtotime($termin->Ende)) . ' Uhr</p>
                    <h4>' . $termin->Bezeichnung . '</h4>
                    <p class="termin adress">' . $termin->Adresse . '</p>
                    <p class="termin adress">' . $termin->PLZ . ' ' . $termin->Ort . '</p>
                    <p class="last adress">' . $termin->staatBez . '</p>
                ');

                $sql = '
                    SELECT
                        tbl_user.Nickname,
                        tbl_einladungsstati.Bezeichnung as einsta
                    FROM tbl_termine_einladungen
                    INNER JOIN tbl_user ON tbl_user.IDUser=tbl_termine_einladungen.FIDUser
                    INNER JOIN tbl_einladungsstati ON tbl_einladungsstati.IDEinladungsstatus=tbl_termine_einladungen.FIDEinladungsstatus
                    WHERE(
                        FIDTermin = ' . $termin->IDTermin . '
                    )
                ';

                $einladungen = $conn->query($sql)or die('Fehler in der Query: ' . $conn->error . '<br>' . $sql);

                echo('<div class="einladung">
                        <p>eingeladen sind:</p>
                ');
                while($einladung = $einladungen->fetch_object()){
                    echo('     
                        <p>' . $einladung->Nickname . ': ' . $einladung->einsta . '</p>  
                    ');
                } 
                echo('
                        </div>
                    </article>
                ');
            }

            echo('
                </section>
            ');
        ?>
    </body>
</html>