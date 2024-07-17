<fieldset>
	<legend>Ihre Daten</legend>
	<label for="Nachname" data-required>Nachname:</label>
	<input type="text" name="Nachname" id="Nachname" required>
	<label for="Vorname" data-required>Vorname:</label>
	<input type="text" name="Vorname" id="Vorname" required>
	<label for="Emailadresse" data-required>Emailadresse:</label>
	<input type="email" name="Emailadresse" id="Emailadresse" required>
	<label for="Telefon">Telefon:</label>
	<input type="tel" name="Telefon" id="Telefon">
	<label for="Adresse" data-required>Adresse:</label>
	<input type="text" name="Adresse" id="Adresse" required>
	<label for="PLZ" data-required>PLZ:</label>
	<input type="text" name="PLZ" id="PLZ" required>
	<label for="Ort" data-required>Ort:</label>
	<input type="text" name="Ort" id="Ort" required>
	<label for="FIDStaat" data-required>Staat:</label>
	<?php echo(staaten_show()); ?>
	<label for="GebDatum">Geburtsdatum:</label>
	<input type="date" name="GebDatum" id="GebDatum">
	<input type="button" onclick="store(6);" value="Bestellung abschicken">
</fieldset>