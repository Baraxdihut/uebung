<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Neues Spiel erfassen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Neues Spiel erfassen</h1>
        <form action="insert.php" method="post">
            <div class="mb-3">
                <label for="spielname" class="form-label">Spielname:</label>
                <input type="text" class="form-control" id="spielname" name="spielname" required>
            </div>

            <div class="mb-3">
                <label for="kategorie" class="form-label">Kategorie:</label>
                <select class="form-select" id="kategorie" name="kategorie" required>
                    <option value="">Bitte wählen</option>
                    <?php
                    // Abfrage für Kategorien
                    $sql = "SELECT KategorieID, KategorieName FROM Kategorien";
                    $result = $conn->query($sql);
                    // Dropdown-Optionen für Kategorie aus der Datenbank hinzufügen
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["KategorieID"] . "'>" . $row["KategorieName"] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="zustand" class="form-label">Zustand:</label>
                <select class="form-select" id="zustand" name="zustand" required>
                    <option value="">Bitte wählen</option>
                    <?php
                    // Abfrage für Zustände
                    $sql = "SELECT ZustandID, Zustandsname FROM Zustand";
                    $result = $conn->query($sql);
                    // Dropdown-Optionen für Zustand aus der Datenbank hinzufügen
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["ZustandID"] . "'>" . $row["Zustandsname"] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="verfuegbarkeit" class="form-label">Verfügbarkeit:</label>
                <select class="form-select" id="verfuegbarkeit" name="verfuegbarkeit" required>
                    <option value="">Bitte wählen</option>
                    <?php
                    // Abfrage für Verfügbarkeiten
                    $sql = "SELECT VerfuegbarkeitID, Verfuegbarkeitname FROM Verfuegbarkeit";
                    $result = $conn->query($sql);
                    // Dropdown-Optionen für Verfügbarkeit aus der Datenbank hinzufügen
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row["VerfuegbarkeitID"] . "'>" . $row["Verfuegbarkeitname"] . "</option>";
                        }
                    }
                    $conn->close();
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Speichern</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
