<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formular mit Dropdown-Listen</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .dropdown-section {
            display: none;
        }
        .visible {
            display: block !important;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Formular</h1>
 
       
        <div id="section-1" class="dropdown-section visible">
            <label for="rahmen">Rahmen:</label>
            <select id="rahmen" class="form-control">
                <option value="hart">Hart</option>
                <option value="weich">Weich</option>
                <option value="superweich">Superweich</option>
            </select>
            <button class="btn btn-primary mt-3" onclick="showNextSection(1)">OK</button>
        </div>
 
     
        <div id="section-2" class="dropdown-section">
            <label for="farbe">Farbe:</label>
            <select id="farbe" class="form-control">
                <option value="rot">Rot</option>
                <option value="weiss">Weiss</option>
                <option value="blau">Blau</option>
            </select>
            <button class="btn btn-primary mt-3" onclick="showNextSection(2)">OK</button>
        </div>
 
       
        <div id="section-3" class="dropdown-section">
            <label for="motor">Motor:</label>
            <select id="motor" class="form-control">
                <option value="500W">500W</option>
                <option value="750W">750W</option>
                <option value="900W">900W</option>
            </select>
            <button class="btn btn-primary mt-3" onclick="showNextSection(3)">OK</button>
        </div>
 
   
        <div id="section-4" class="dropdown-section">
            <label for="auswahl1">Weitere Auswahl 1:</label>
            <select id="auswahl1" class="form-control">
                <option value="option1">Option 1</option>
                <option value="option2">Option 2</option>
                <option value="option3">Option 3</option>
            </select>
            <button class="btn btn-primary mt-3" onclick="showNextSection(4)">OK</button>
        </div>
 
       
        <div id="section-5" class="dropdown-section">
            <label for="auswahl2">Weitere Auswahl 2:</label>
            <select id="auswahl2" class="form-control">
                <option value="option1">Option 1</option>
                <option value="option2">Option 2</option>
                <option value="option3">Option 3</option>
            </select>
            <button class="btn btn-primary mt-3">Abschließen</button>
        </div>
    </div>
 
    <script>
        document.getElementById('section-1').classList.add('visible');
 
        function showNextSection(currentSection) {
            var nextSection = currentSection + 1;
            document.getElementById('section-' + nextSection).classList.add('visible');
        }
    </script>
</body>
</html>
 
hat Kontextmenü