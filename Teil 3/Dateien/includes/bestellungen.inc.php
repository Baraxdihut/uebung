<?php
function motoren_show($id=0) {
	global $conn;
	$r = '
		<select name="FIDMotor" id="FIDMotor">
			<option value="0">bitte wählen</option>
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
	';
	return $r;
}

function rahmentypen_show($id=0) {
	global $conn;
	$r = '
		<select name="FIDRahmentyp" id="FIDRahmentyp">
			<option value="0">bitte wählen</option>
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
	';
	return $r;
}
?>