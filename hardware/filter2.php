<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch manufacturers for the dropdown
$sql_manufacturers = "SELECT IDHersteller, Hersteller FROM tbl_hersteller ORDER BY Hersteller";
$result_manufacturers = $conn->query($sql_manufacturers);

$manufacturers = [];
while ($row = $result_manufacturers->fetch_assoc()) {
    $manufacturers[] = $row;
}

// Handle form submission and filtering
$where_clauses = [];
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!empty($_GET['manufacturer'])) {
        $manufacturer = intval($_GET['manufacturer']);
        $where_clauses[] = "tbl_computer.FIDHersteller = $manufacturer";
    }

    if (!empty($_GET['installed_before'])) {
        $installed_before = $_GET['installed_before'];
        $where_clauses[] = "tbl_computer.Installationszeitpunkt <= '$installed_before'";
    }

    if (!empty($_GET['installed_after'])) {
        $installed_after = $_GET['installed_after'];
        $where_clauses[] = "tbl_computer.Installationszeitpunkt >= '$installed_after'";
    }
}

$where_sql = '';
if (count($where_clauses) > 0) {
    $where_sql = 'WHERE ' . implode(' AND ', $where_clauses);
}

// Fetch filtered computers
$sql_computers = "
SELECT 
    tbl_computer.Bezeichnung,
    tbl_computer.IDComputer,
    tbl_computer.Installationszeitpunkt,
    tbl_hersteller.Hersteller,
    tbl_betriebssysteme.Betriebssystem,
    tbl_versionen.Version
FROM tbl_computer
LEFT JOIN tbl_hersteller ON tbl_computer.FIDHersteller = tbl_hersteller.IDHersteller
LEFT JOIN tbl_betriebssystem_version ON tbl_computer.FIDBetriebssystemVersion = tbl_betriebssystem_version.IDBetriebssystemVersion
LEFT JOIN tbl_betriebssysteme ON tbl_betriebssystem_version.FIDBetriebssystem = tbl_betriebssysteme.IDBetriebssystem
LEFT JOIN tbl_versionen ON tbl_betriebssystem_version.FIDVersion = tbl_versionen.IDVersion
$where_sql
ORDER BY tbl_computer.Bezeichnung";

$result_computers = $conn->query($sql_computers);

$computers = [];
while ($row = $result_computers->fetch_assoc()) {
    $computers[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hersteller Filter</title>
</head>
<body>
    <h1>Hersteller</h1>
    <form method="GET" action="">
        <label for="manufacturer">Hersteller:</label>
        <select name="manufacturer" id="manufacturer">
            <option value="">Bitte Hersteller wählen</option>
            <?php foreach ($manufacturers as $manufacturer): ?>
                <option value="<?php echo $manufacturer['IDHersteller']; ?>" <?php if (isset($_GET['manufacturer']) && $_GET['manufacturer'] == $manufacturer['IDHersteller']) echo 'selected'; ?>>
                    <?php echo $manufacturer['Hersteller']; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="installed_before">Installiert vor:</label>
        <input type="date" name="installed_before" id="installed_before" value="<?php echo isset($_GET['installed_before']) ? $_GET['installed_before'] : ''; ?>">
        <br>
        <label for="installed_after">Installiert nach:</label>
        <input type="date" name="installed_after" id="installed_after" value="<?php echo isset($_GET['installed_after']) ? $_GET['installed_after'] : ''; ?>">
        <br>
        <button type="submit">Filtern</button>
    </form>

    <h2>Computer:</h2>
    <ul>
        <?php foreach ($computers as $computer): ?>
            <li>
                <?php echo "{$computer['Bezeichnung']} ({$computer['Hersteller']}) installiert am {$computer['Installationszeitpunkt']} mit {$computer['Betriebssystem']} Version {$computer['Version']}"; ?>
            </li>
        <?php endforeach; ?>
    </ul>

    <h2>Betriebssysteme:</h2>
    <ul>
        <?php
        $os_list = [];
        foreach ($computers as $computer) {
            if (!in_array($computer['Betriebssystem'], $os_list)) {
                $os_list[] = $computer['Betriebssystem'];
                echo "<li>{$computer['Betriebssystem']}</li>";
            }
        }
        ?>
    </ul>
</body>
</html>
