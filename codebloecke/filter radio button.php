<?php
require 'db.php';

$category = '';
$products = [];

// Überprüfen, ob ein Filter gesetzt wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['category'];

    // SQL-Abfrage zum Filtern der Produkte nach Kategorie
    $stmt = $conn->prepare("SELECT id, name FROM products WHERE category = ?");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();

    // Ergebnisse in ein Array speichern
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Produkte filtern</title>
</head>
<body>

<h2>Produkte nach Kategorie filtern</h2>
<form method="post" action="">
    <div>
        <input type="radio" id="category1" name="category" value="Kategorie1" <?php echo ($category == 'Kategorie1') ? 'checked' : ''; ?>>
        <label for="category1">Kategorie 1</label>
    </div>
    <div>
        <input type="radio" id="category2" name="category" value="Kategorie2" <?php echo ($category == 'Kategorie2') ? 'checked' : ''; ?>>
        <label for="category2">Kategorie 2</label>
    </div>
    <div>
        <input type="radio" id="category3" name="category" value="Kategorie3" <?php echo ($category == 'Kategorie3') ? 'checked' : ''; ?>>
        <label for="category3">Kategorie 3</label>
    </div>
    <div>
        <button type="submit">Filtern</button>
    </div>
</form>

<h2>Gefilterte Produkte</h2>
<?php if (!empty($products)): ?>
    <ul>
        <?php foreach ($products as $product): ?>
            <li><?php echo htmlspecialchars($product['name']); ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Keine Produkte gefunden.</p>
<?php endif; ?>

</body>
</html>
