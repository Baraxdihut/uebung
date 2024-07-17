<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Neuer Patient</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Neuer Patient</h2>
    <form action="insert.php" method="post">
        <div class="form-group">
            <label for="vorname">Vorname:</label>
            <input type="text" class="form-control" id="vorname" name="Vorname" required>
        </div>
        <div class="form-group">
            <label for="nachname">Nachname:</label>
            <input type="text" class="form-control" id="nachname" name="Nachname" required>
        </div>
        <div class="form-group">
            <label for="versicherungsnummer">Versicherungsnummer:</label>
            <input type="text" class="form-control" id="versicherungsnummer" name="Versicherungsnummer" required>
        </div>
        <div class="form-group">
            <label for="geburtsdatum">Geburtsdatum:</label>
            <input type="date" class="form-control" id="geburtsdatum" name="Geburtsdatum" required>
        </div>
        <div class="form-group">
            <label for="straße">Straße:</label>
            <input type="text" class="form-control" id="straße" name="Straße" required>
        </div>
        <div class="form-group">
            <label for="postleitzahl">Postleitzahl:</label>
            <input type="text" class="form-control" id="postleitzahl" name="Postleitzahl" required>
        </div>
        <div class="form-group">
            <label for="ort">Ort:</label>
            <input type="text" class="form-control" id="ort" name="Ort" required>
        </div>
        <div class="form-group">
            <label for="telefonnummer">Telefonnummer:</label>
            <input type="text" class="form-control" id="telefonnummer" name="Telefonnummer" required>
        </div>
        <button type="submit" class="btn btn-primary">Absenden</button>
    </form>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- AJAX-Funktion-->
<script>
    function loadContent(page) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("content").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", page, true);
        xhttp.send();
    }
</script>

</body>
</html>
