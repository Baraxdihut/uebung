<?php
function rahmentypen_show($id=0) {
	global $conn;
	$r = '
		<label for="FIDRahmentyp">Bitte wählen Sie einen Rahmentypen:</label>
		<select name="FIDRahmentyp" id="FIDRahmentyp">
	';
	
	$sql = "
		SELECT * FROM tbl_rahmentypen
		ORDER BY Bezeichnung ASC
	";
	$rahmentypen = $conn->query($sql) or tdie("Fehler in der Query: " . $conn->error);
	while($rahmentyp = $rahmentypen->fetch_object()) {
		if($id==$rahmentyp->IDRahmentyp) { $sel = "selected"; }
		else { $sel = ""; }
		$r.= '
			<option value="' . $rahmentyp->IDRahmentyp . '" ' . $sel . '>' . $rahmentyp->Bezeichnung . '</option>';'
		';
	}
	
	$r.= '
		</select>
		<input type="button" onclick="store(1);" value="ok">
	';
	return $r;
}

function farben_show($idRahmentyp,$id=0) {
	global $conn;
	$r = '
		<label for="FIDFarbe">Bitte wählen Sie eine Farbe:</label>
		<select name="FIDFarbe" id="FIDFarbe">
	';
	
	$sql = "
		SELECT tbl_farben.* FROM tbl_rahmenfarbkombinationen
		INNER JOIN tbl_farben ON tbl_farben.IDFarbe=tbl_rahmenfarbkombinationen.FIDFarbe
		WHERE(
			tbl_rahmenfarbkombinationen.FIDRahmentyp=" . $idRahmentyp . "
		)
		ORDER BY tbl_farben.Bezeichnung ASC
	";
	$farben = $conn->query($sql) or tdie("Fehler in der Query: " . $conn->error);
	while($farbe = $farben->fetch_object()) {
		if($id==$farbe->IDFarbe) { $sel = "selected"; }
		else { $sel = ""; }
		$r.= '
			<option value="' . $farbe->IDFarbe . '" ' . $sel . '>' . $farbe->Bezeichnung . '</option>';'
		';
	}
	
	$r.= '
		</select>
		<input type="button" onclick="store(2);" value="ok">
	';
	return $r;
}
function motoren_show($id=0) {
	global $conn;
	$r = '
		<label for="FIDMotor">Bitte wählen Sie einen Motor:</label>
		<select name="FIDMotor" id="FIDMotor">
	';
	
	$sql = "
		SELECT * FROM tbl_motoren
		ORDER BY Bezeichnung ASC
	";
	$motoren = $conn->query($sql) or tdie("Fehler in der Query: " . $conn->error);
	while($motor = $motoren->fetch_object()) {
		if($id==$motor->IDMotor) { $sel = "selected"; }
		else { $sel = ""; }
		$r.= '
			<option value="' . $motor->IDMotor . '" ' . $sel . '>' . $motor->Bezeichnung . '</option>';'
		';
	}
	
	$r.= '
		</select>
		<input type="button" onclick="store(3);" value="ok">
	';
	return $r;
}
function bremsen_show($id=0) {
	global $conn;
	$r = '
		<label for="FIDBremse">Bitte wählen Sie ein Bremssystem:</label>
		<select name="FIDBremse" id="FIDBremse">
	';
	
	$sql = "
		SELECT * FROM tbl_bremsen
		ORDER BY Bezeichnung ASC
	";
	$bremsen = $conn->query($sql) or tdie("Fehler in der Query: " . $conn->error);
	while($bremse = $bremsen->fetch_object()) {
		if($id==$bremse->IDBremse) { $sel = "selected"; }
		else { $sel = ""; }
		$r.= '
			<option value="' . $bremse->IDBremse . '" ' . $sel . '>' . $bremse->Bezeichnung . '</option>';'
		';
	}
	
	$r.= '
		</select>
		<input type="button" onclick="store(4);" value="ok">
	';
	return $r;
}
function beleuchtungen_show($id=0) {
	global $conn;
	$r = '
		<label for="FIDBeleuchtung">Bitte wählen Sie ggf. eine Beleuchtung:</label>
		<select name="FIDBeleuchtung" id="FIDBeleuchtung">
			<option value="0">keine Beleuchtung</option>
	';
	
	$sql = "
		SELECT * FROM tbl_beleuchtungen
		ORDER BY Bezeichnung ASC
	";
	$beleuchtungen = $conn->query($sql) or tdie("Fehler in der Query: " . $conn->error);
	while($beleuchtung = $beleuchtungen->fetch_object()) {
		if($id==$beleuchtung->IDBeleuchtung) { $sel = "selected"; }
		else { $sel = ""; }
		$r.= '
			<option value="' . $beleuchtung->IDBeleuchtung . '" ' . $sel . '>' . $beleuchtung->Bezeichnung . '</option>';'
		';
	}
	
	$r.= '
		</select>
		<input type="button" onclick="store(5);" value="Bestellen">
	';
	return $r;
}
function staaten_show() {
	global $conn;
	$r = '
		<select name="FIDStaat" id="FIDStaat">
	';
	
	$sql = "
		SELECT * FROM tbl_staaten
		ORDER BY Bezeichnung ASC
	";
	$staaten = $conn->query($sql) or tdie("Fehler in der Query: " . $conn->error);
	while($staat = $staaten->fetch_object()) {
		$r.= '
			<option value="' . $staat->IDStaat . '">' . $staat->Bezeichnung . '</option>';'
		';
	}
	
	$r.= '
		</select>
	';
	return $r;
}
?>