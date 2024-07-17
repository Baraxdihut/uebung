<?
function filterInput($data) {
    $data = trim($data); // Entfernt Leerzeichen am Anfang und Ende
    $data = stripslashes($data); // Entfernt Backslashes
    $data = htmlspecialchars($data); // Konvertiert spezielle Zeichen in HTML-Entities
    return $data;
}

// Beispielnutzung:
$filtered_data = filterInput($_POST['input_name']);
