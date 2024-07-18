<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_hardware";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function displayForm($conn) {
    $herstellerFilter = isset($_GET['hersteller']) ? $_GET['hersteller'] : '';
    $installiertVor = isset($_GET['installiert_vor']) ? $_GET['installiert_vor'] : '';
    $installiertBis = isset($_GET['installiert_bis']) ? $_GET['installiert_bis'] : '';

    echo '<form method="GET" style="margin-bottom: 20px;">
            <div class="form-group">
                <label for="hersteller">Hersteller:</label>
                <select name="hersteller" id="hersteller" class="form-control">
                    <option value="">Bitte Hersteller wählen</option>';
                
    $sql = "SELECT DISTINCT Hersteller FROM tbl_hersteller";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $selected = ($row['Hersteller'] == $herstellerFilter) ? 'selected' : '';
        echo "<option value=\"{$row['Hersteller']}\" $selected>{$row['Hersteller']}</option>";
    }

    echo '  </select>
            </div>
            <div class="form-group">
                <label for="installiert_vor">Installiert vor:</label>
                <input type="date" id="installiert_vor" name="installiert_vor" class="form-control" value="' . $installiertVor . '">
            </div>
            <div class="form-group">
                <label for="installiert_bis">Installiert bis:</label>
                <input type="date" id="installiert_bis" name="installiert_bis" class="form-control" value="' . $installiertBis . '">
            </div>
            <button type="submit" class="btn btn-primary">Filtern</button>
          </form>';
}

function displayComputers($conn) {
    $herstellerFilter = isset($_GET['hersteller']) ? $_GET['hersteller'] : '';
    $installiertVor = isset($_GET['installiert_vor']) ? $_GET['installiert_vor'] : '';
    $installiertBis = isset($_GET['installiert_bis']) ? $_GET['installiert_bis'] : '';

    $sql = "SELECT tbl_computer.IDComputer, tbl_computer.Bezeichnung, tbl_computer.Installationszeitpunkt, tbl_hersteller.Hersteller, 
                   tbl_betriebssysteme.Betriebssystem, tbl_versionen.Version
            FROM tbl_computer
            LEFT JOIN tbl_hersteller ON tbl_computer.FIDHersteller = tbl_hersteller.IDHersteller
            LEFT JOIN tbl_betriebssystem_version ON tbl_computer.FIDBetriebssystemVersion = tbl_betriebssystem_version.IDBetriebssystemVersion
            LEFT JOIN tbl_betriebssysteme ON tbl_betriebssystem_version.FIDBetriebssystem = tbl_betriebssysteme.IDBetriebssystem
            LEFT JOIN tbl_versionen ON tbl_betriebssystem_version.FIDVersion = tbl_versionen.IDVersion
            WHERE (tbl_hersteller.Hersteller = ? OR ? = '') 
            AND (tbl_computer.Installationszeitpunkt <= ? OR ? = '')
            AND (tbl_computer.Installationszeitpunkt >= ? OR ? = '')
            ORDER BY tbl_hersteller.Hersteller, tbl_computer.Bezeichnung";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssss', $herstellerFilter, $herstellerFilter, $installiertBis, $installiertBis, $installiertVor, $installiertVor);
    $stmt->execute();
    $result = $stmt->get_result();

    $currentHersteller = null;
    echo "<h2>Computer:</h2>";
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row['Hersteller'] != $currentHersteller) {
                if ($currentHersteller !== null) {
                    echo "</ul>";
                }
                $currentHersteller = $row['Hersteller'];
                echo "<ul><strong>$currentHersteller</strong>";
            }
            echo "<li>{$row['Bezeichnung']}: {$row['Betriebssystem']} {$row['Version']}, installiert am {$row['Installationszeitpunkt']}</li>";
        }
        echo "</ul>";
    } else {
        echo "Keine Computer gefunden.";
    }
}

function displayOperatingSystems($conn) {
    $herstellerFilter = isset($_GET['hersteller']) ? $_GET['hersteller'] : '';
    $installiertVor = isset($_GET['installiert_vor']) ? $_GET['installiert_vor'] : '';
    $installiertBis = isset($_GET['installiert_bis']) ? $_GET['installiert_bis'] : '';

    $sql = "SELECT DISTINCT tbl_betriebssysteme.Betriebssystem
            FROM tbl_betriebssysteme
            LEFT JOIN tbl_betriebssystem_version ON tbl_betriebssysteme.IDBetriebssystem = tbl_betriebssystem_version.FIDBetriebssystem
            LEFT JOIN tbl_computer ON tbl_betriebssystem_version.IDBetriebssystemVersion = tbl_computer.FIDBetriebssystemVersion
            LEFT JOIN tbl_hersteller ON tbl_computer.FIDHersteller = tbl_hersteller.IDHersteller
            WHERE (tbl_hersteller.Hersteller = ? OR ? = '')
            AND (tbl_computer.Installationszeitpunkt <= ? OR ? = '')
            AND (tbl_computer.Installationszeitpunkt >= ? OR ? = '')";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssssss', $herstellerFilter, $herstellerFilter, $installiertBis, $installiertBis, $installiertVor, $installiertVor);
    $stmt->execute();
    $result = $stmt->get_result();

    echo "<h2>Betriebssysteme:</h2>";
    if ($result->num_rows > 0) {
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            echo "<li>{$row['Betriebssystem']}</li>";
        }
        echo "</ul>";
    } else {
        echo "Keine Betriebssysteme gefunden.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Produkte von Herstellern</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1, h2 {
            margin-top: 20px;
        }
        ul {
            list-style-type: none;
            padding-left: 0;
        }
        li {
            margin: 5px 0;
        }
        /* Tab styles */
        .tab {
            overflow: hidden;
            border-bottom: 1px solid #ccc;
            background-color: #f1f1f1;
        }
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }
        .tab button:hover {
            background-color: #ddd;
        }
        .tab button.active {
            background-color: #ccc;
        }
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border-top: none;
        }
    </style>
    <script>
        function openTab(evt, tabName) {
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
        // Open the default tab
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("defaultOpen").click();
        });
    </script>
</head>
<body>

<div class="container">
    <h1>Produkte von Herstellern</h1>

    <?php displayForm($conn); ?>

    <div class="tab">
        <button class="tablinks" onclick="openTab(event, 'Computer')" id="defaultOpen">Computer</button>
        <button class="tablinks" onclick="openTab(event, 'Betriebssysteme')">Betriebssysteme</button>
    </div>

    <div id="Computer" class="tabcontent">
        <?php displayComputers($conn); ?>
    </div>

    <div id="Betriebssysteme" class="tabcontent">
        <?php displayOperatingSystems($conn); ?>
    </div>
</div>

</body>
</html>

<?php
$conn->close();
?>
