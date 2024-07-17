<?php
require_once("includes/config.inc.php");
require_once("includes/conn.inc.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bestellungen</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="home.php">Home</a></li>
            <li><a href="konfigurator.php">Konfigurator</a></li>
            <li><a href="bestelluebersicht.php">Bestellübersicht</a></li>
        </ul>
    </nav>
    <form action="search_filter.php" method="GET">
        <div>
            <label for="from">von:</label>
            <input type="date" id="from" name="from">
        </div>
        <div>
            <label for="to">bis:</label>
            <input type="date" id="to" name="to">
        </div>
        <div>
            <label for="motor">Motorleistung:</label>
            <select class="form-control" id="motor" name="motor">
                <option value="">Bitte wählen</option>
                <?php
                $sql = "SELECT IDMotor, Bezeichnung FROM tbl_motoren";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row['IDMotor'] . "\">" . $row['Bezeichnung'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Keine Motoren gefunden</option>";
                }
                ?>
            </select>
        </div>
        <div>
            <label for="rahmentyp">Rahmentyp:</label>
            <select class="form-control" id="rahmentyp" name="rahmentyp">
                <option value="">Bitte wählen</option>
                <?php
                $sql = "SELECT IDRahmentyp, Bezeichnung FROM tbl_rahmentypen";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value=\"" . $row['IDRahmentyp'] . "\">" . $row['Bezeichnung'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Keine Rahmentypen gefunden</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit">Filtern</button>
    </form>

    <div id="results">
        <?php include 'search_filter.php'; ?>
    </div>
</body>
</html>
