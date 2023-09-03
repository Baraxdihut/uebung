<?php
require('includes/config.inc.php');
require('includes/common.inc.php');
require('includes/conn.inc.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charser="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Termin je User</title>
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

        <h1>Termin je User</h1>

        <?php

            $sql = '
                SELECT 
                    tbl_user.IDUser,
                    tbl_user.Nickname,
                    tbl_user.Emailadresse,
                    tbl_user.Vorname,
                    tbl_user.Nachname,
                    tbl_user.Notiz
                FROM tbl_user
                ORDER BY Nickname ASC, Emailadresse ASC
            ';

            $userQ = $conn->query($sql)or die('Fehler in der Query: ' . $conn->error . '<br>' . $sql);

            while($user = $userQ->fetch_object()){
                echo('
                    <section>
                        <p class="first">' . $user->Nickname . ' (<a href="mailto:' . $user->Emailadresse . '">' . $user->Emailadresse . '</a>)</p>
                        <p class="termin">' . $user->Vorname . ' ' . $user->Nachname . '</p>
                        <p class="last adress">' . $user->Notiz . '</p>
                ');

                $sql = '
                    SELECT
                        tbl_termine.Beginn,
                        tbl_termine.Ende,
                        tbl_termine.Bezeichnung,
                        tbl_termine.PLZ,
                        tbl_termine.Ort,
                        tbl_staaten.Bezeichnung as staatBez,
                        tbl_kategorien.Bezeichnung as KatBez
                    FROM tbl_termine
                    LEFT JOIN tbl_kategorien ON tbl_kategorien.IDKategorie=tbl_termine.FIDKategorie
                    INNER JOIN tbl_staaten ON tbl_staaten.IDStaat=tbl_termine.FIDStaat
                    WHERE(
                        tbl_termine.FIDUser = ' . $user->IDUser . '
                    )
                    ORDER BY Beginn ASC
                ';

                $termine = $conn->query($sql)or die('Fehler in der Query: ' . $conn->error . '<br>' . $sql);

                while($termin = $termine->fetch_object()){
                    echo('
                        <article class="' . $termin->KatBez . '">
                            <p class="date">von ' . date('d.m.Y h:i', strtotime($termin->Beginn)) . ' Uhr bis ' . date('d.m.Y h:i', strtotime($termin->Ende)) . ' Uhr</p>
                            <h4>' . $termin->Bezeichnung . '</h4>
                            <p class="termin adress">' . $termin->PLZ . ' ' . $termin->Ort . '</p>
                            <p class="last adress">' . $termin->staatBez . '</p>
                        </article>
                    ');
                }
                echo('
                    </section>
                ');
            }
        ?>
    </body>
</html>