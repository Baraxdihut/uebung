<?php
require('includes/config.inc.php');
require('includes/common.inc.php');
require('includes/conn.inc.php');
$w = '';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alle Termine</title>
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

        <h1>Alle Termine</h1>

        <form method="post">
            <fieldset>
                <legend>Termine Filtern</legend>
                <label>Terminkategorie:
                    <select name="selkat">
                        <?php
                        $sql = '
                            SELECT 
                                tbl_kategorien.*,
                                tbl_user.Nickname
                            FROM tbl_kategorien
                            LEFT JOIN tbl_user ON tbl_user.IDUser=tbl_kategorien.FIDUser
                            ORDER BY Bezeichnung ASC
                        ';

                        $kategorien = $conn->query($sql)or die('Fehler in der Query: ' . $conn->error . '<br>' . $sql);

                        echo('
                            <option value="0" selected>-</option>
                        ');

                        while($kat = $kategorien->fetch_object()){

                            $nick = '';

                            if(!empty($kat->Nickname)){
                                $nick = '(' . $kat->Nickname . ')';
                            }else{
                                $nick = '';
                            }
                            echo('
                                <option value="' . $kat->IDKategorie . '">' . $kat->Bezeichnung . ' ' . $nick . '</option>
                            ');
                        }
                        ?>
                    </select>
                </label>
                <label>Terminbezeichnung:
                    <input type="search" name="Tbez">
                </label>
                <label>Nickname/Emailadresse:
                    <input type="search" name="niem">
                </label>
                <label>Datum:</label>
                <label>von
                    <input type="date" name="von">
                </label>
                <label>bis:
                    <input type="date" name="bis">
                </label>
                <input class="filtern" type="submit" value="Filtern">
            </fieldset>
        </form>

        <?php
        if(count($_POST)>0){
            $arr = [];

            if(isset($_POST['selkat']) && $_POST['selkat']>1){
                $arr[] = 'tbl_termine.FIDKategorie = ' . $_POST['selkat'] . '';
            }
            if(strlen($_POST['Tbez'])>0){
                $arr[] = 'tbl_termine.Bezeichnung LIKE "%' . $_POST['Tbez'] . '%"';
            }
            if(strlen($_POST['niem'])>0){
                $arr[] = 'tbl_user.Nickname LIKE "%' . $_POST['niem'] . '%" OR tbl_user.Emailadresse LIKE "%' . $_POST['niem'] . '%"';
            }
            if(strlen($_POST['von'])>0){
                $arr[] = 'tbl_termine.Beginn LIKE "%' . $_POST['von'] . '%"';
            }
            if(strlen($_POST['bis'])>0){
                $arr[] = 'tbl_termine.Ende LIKE "%' . $_POST['bis'] . '%"';
            }

            if(count($arr)>0){
                $w = '
                    WHERE(
                        ' . implode(' AND ', $arr) . '
                    )
                ';
            }
        }

        $sql = '
            SELECT
                tbl_termine.*,
                tbl_staaten.Bezeichnung as staatBez,
                tbl_kategorien.Bezeichnung as KatBez,
                tbl_user.Nickname
            FROM tbl_termine
            INNER JOIN tbl_user ON tbl_user.IDUser=tbl_termine.FIDUser
            INNER JOIN tbl_staaten ON tbl_staaten.IDStaat=tbl_termine.FIDStaat
            INNER JOIN tbl_kategorien ON tbl_kategorien.IDKategorie=tbl_termine.FIDKategorie
            ' . $w . '
            ORDER BY tbl_termine.Beginn DESC
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
                </article>
            ');
        }

        echo('
            </section>
        ');
        ?>
    </body>
</html>