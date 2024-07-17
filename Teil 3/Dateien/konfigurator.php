<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");
require("includes/konfigurator.inc.php");

$msg = "";
$data = array(
	"step" => 0,
	"FIDRahmentyp" => 0,
	"FIDFarbe" => 0,
	"FIDMotor" => 0,
	"FIDBremse" => 0,
	"FIDBeleuchtung" => 0
);

if(count($_POST)>0) {
	foreach($data as $itm=>$val) {
		if(isset($_POST[$itm])) { $data[$itm] = intval($_POST[$itm]); }
	}
	
	if($data["step"]==6) {
		//Bestellung
		foreach($_POST as $itm=>$val) {
			$_POST[$itm] = $conn->real_escape_string($_POST[$itm]);
		}
		$sql = "
			SELECT IDKunde FROM tbl_kunden
			WHERE(
				Nachname='" . $_POST["Nachname"] . "' AND
				Vorname='" . $_POST["Vorname"] . "' AND
				Emailadresse='" . $_POST["Emailadresse"] . "' AND
				Adresse='" . $_POST["Adresse"] . "' AND
				PLZ='" . $_POST["PLZ"] . "' AND
				Ort='" . $_POST["Ort"] . "' AND
				FIDStaat='" . $_POST["FIDStaat"] . "' AND
				GebDatum='" . $_POST["GebDatum"] . "'
			)
		";
		$kunden = $conn->query($sql) or tdie("Fehler in der Query: " . $conn->error . '<br>' . $sql);
		if($kunden->num_rows==1) {
			$kunde = $kunden->fetch_object();
			$FIDKunde = $kunde->IDKunde;
		}
		else {
			$sql = "
				INSERT INTO tbl_kunden
					(Nachname, Vorname, Emailadresse, Telefon, Adresse, PLZ, Ort, FIDStaat, GebDatum)
				VALUES (
					'" . $_POST["Nachname"] . "',
					'" . $_POST["Vorname"] . "',
					'" . $_POST["Emailadresse"] . "',
					'" . $_POST["Telefon"] . "',
					'" . $_POST["Adresse"] . "',
					'" . $_POST["PLZ"] . "',
					'" . $_POST["Ort"] . "',
					'" . $_POST["FIDStaat"] . "',
					'" . $_POST["GebDatum"] . "'
				)
			";
			$ins = $conn->query($sql) or tdie("Fehler in der Query: " . $conn->error . '<br>' . $sql);
			$FIDKunde = $conn->insert_id;
		}
		
		if($_POST["FIDBeleuchtung"]==0) {
			$_POST["FIDBeleuchtung"] = "NULL";
		}
		$sql = "
			INSERT INTO tbl_bestellungen
				(FIDKunde, FIDRahmentyp, FIDFarbe, FIDMotor, FIDBremse, FIDBeleuchtung)
			VALUES (
				" . $FIDKunde . ",
				" . $_POST["FIDRahmentyp"] . ",
				" . $_POST["FIDFarbe"] . ",
				" . $_POST["FIDMotor"] . ",
				" . $_POST["FIDBremse"] . ",
				" . $_POST["FIDBeleuchtung"] . "
			)
		";
		$ins = $conn->query($sql) or tdie("Fehler in der Query: " . $conn->error . '<br>' . $sql);
		if($ins) { 
			$msg = '<p class="success">Vielen Dank - Ihre Bestellung wird nun verarbeitet.</p>';
		}
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Konfigurator</title>
<?php include("content/parts/head.part.html"); ?>
<script>
	function store(step) {
		document.getElementById("step").value = step;
		document.getElementById("frm").submit();
	}
</script>
</head>

<body>
	<?php include("content/parts/navigation.part.html"); ?>
	<form name="frm" id="frm" method="post">
		<input type="hidden" name="step" id="step" value="<?php echo($step); ?>">
		<?php
		if($data["step"]<6) {
			if($data["step"]>=0) {
				//Rahmentyp
				echo(rahmentypen_show($data["FIDRahmentyp"]));
			}
			if($data["step"]>=1) {
				//Farbe
				echo(farben_show($data["FIDRahmentyp"],$data["FIDFarbe"]));
			}
			if($data["step"]>=2) {
				//Motor
				echo(motoren_show($data["FIDMotor"]));
			}
			if($data["step"]>=3) {
				//Bremse
				echo(bremsen_show($data["FIDBremse"]));
			}
			if($data["step"]>=4) {
				//Beleuchtung
				echo(beleuchtungen_show($data["FIDBeleuchtung"]));
			}
			if($data["step"]>=5) {
				//Kundendaten
				include("content/parts/kundendaten.part.php");
			}
		}
		else {
			//Bestellung
			echo($msg);
		}
		?>
	</form>
</body>
</html>