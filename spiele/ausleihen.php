<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");

?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Spiel ausleihen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h1>Spiel ausleihen</h1>
        
        <form action="insert_ausleihen.php" method="post">
            <div class="mb-3">
                <label for="kunde">Kunde:</label>
                <select class="form-select" id="kunde" name="kunde" required>
                    <option value="">Bitte wählen</option>
                    <?php
                    // Abfrage alle Kunden
                    $sql = "SELECT KundenID, CONCAT(Vorname, ' ', Nachname) AS Name FROM Kunden";
                    $result = $conn->query($sql);

                    // Dropdown-Optionen für Kunden aus der Datenbank hinzufügen
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["KundenID"] . "'>" . $row["Name"] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="spiel">Spiel:</label>
                <select class="form-select" id="spiel" name="spiel" required>
                    <option value="">Bitte wählen</option>
                    <?php
                    // Abfrage alle verfügbaren Spiele
                    $sql = "SELECT SpielID, Spielname FROM Spiele WHERE VerfuegbarkeitID = 1"; // Beispiel: VerfuegbarkeitID = 1 für verfügbar
                    $result = $conn->query($sql);

                    // Dropdown-Optionen für Spiele aus der Datenbank hinzufügen
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["SpielID"] . "'>" . $row["Spielname"] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="beginn">Beginn der Ausleihe:</label>
                <input type="datetime-local" class="form-control" id="beginn" name="beginn" required>
            </div>

            <div class="mb-3">
                <label for="ende">Ende der Ausleihe:</label>
                <input type="datetime-local" class="form-control" id="ende" name="ende" required>
            </div>

            <button type="submit" class="btn btn-primary">Ausleihen</button>
        </form>

        <?php
        $conn->close();
        ?>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
