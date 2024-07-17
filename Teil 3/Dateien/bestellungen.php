<?php
require("includes/config.inc.php");
require("includes/common.inc.php");
require("includes/conn.inc.php");
require("includes/bestellungen.inc.php");

$msg = "";
$data = array(
	"DatumVon" => "",
	"DatumBis" => "",
	"FIDRahmentyp" => 0,
	"FIDMotor" => 0
);
if(count($_POST)>0) {
	foreach($data as $itm=>$val) {
		if(isset($_POST[$itm])) { $data[$itm] = $_POST[$itm]; }
	}
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Bestellungen</title>
<?php include("content/parts/head.part.html"); ?>
<link rel="stylesheet" href="css/bestellungen.css">
</head>

<body>
	<?php include("content/parts/navigation.part.html"); ?>
	<form name="frm" id="frm" method="post">
		<fieldset id="filter">
			<legend>Filter</legend>
			<label for="DatumVon">von: <input type="date" name="DatumVon" id="DatumVon" value="<?php echo($data["DatumVon"]); ?>"></label>
			<label for="DatumBis">bis: <input type="date" name="DatumBis" id="DatumBis" value="<?php echo($data["DatumBis"]); ?>"></label>
			<label for="FIDMotor">Motorleistung: <?php echo(motoren_show($data["FIDMotor"])); ?></label>
			<label for="FIDRahmentyp">Rahmentyp: <?php echo(rahmentypen_show($data["FIDRahmentyp"])); ?></label>
			<input type="submit" value="filtern">
		</fieldset>
	</form>
	<?php
	$sql = "
		SELECT
			tbl_bestellungen.DatumBestellung,
			tbl_rahmentypen.Bezeichnung AS bezRahmentyp,
			tbl_rahmentypen.Preis AS preisRahmentyp,
			tbl_farben.Bezeichnung AS bezFarbe,
			tbl_motoren.Bezeichnung AS bezMotor,
			tbl_motoren.Preis AS preisMotor,
			tbl_bremsen.Bezeichnung AS bezBremse,
			tbl_bremsen.Preis AS preisBremse,
			tbl_beleuchtungen.Bezeichnung AS bezBeleuchtung,
			tbl_beleuchtungen.Preis AS preisBeleuchtung
		FROM tbl_bestellungen
		INNER JOIN tbl_rahmentypen ON tbl_rahmentypen.IDRahmentyp=tbl_bestellungen.FIDRahmentyp
		INNER JOIN tbl_farben ON tbl_farben.IDFarbe=tbl_bestellungen.FIDFarbe
		INNER JOIN tbl_motoren ON tbl_motoren.IDMotor=tbl_bestellungen.FIDMotor
		INNER JOIN tbl_bremsen ON tbl_bremsen.IDBremse=tbl_bestellungen.FIDBremse
		LEFT JOIN tbl_beleuchtungen ON tbl_beleuchtungen.IDBeleuchtung=tbl_bestellungen.FIDBeleuchtung
	";
	if(count($_POST)>0) {
		$arr_sqlW = array();
		if(isset($_POST["DatumVon"]) && strlen($_POST["DatumVon"])>0) {
			$arr_sqlW[] = "tbl_bestellungen.DatumBestellung>='" . $_POST["DatumVon"] . "'";
		}
		if(isset($_POST["DatumBis"]) && strlen($_POST["DatumBis"])>0) {
			$arr_sqlW[] = "tbl_bestellungen.DatumBestellung<='" . $_POST["DatumBis"] . " 23:59:59'";
		}
		if(isset($_POST["FIDRahmentyp"]) && intval($_POST["FIDRahmentyp"])>0) {
			$arr_sqlW[] = "tbl_bestellungen.FIDRahmentyp='" . $_POST["FIDRahmentyp"] . "'";
		}
		if(isset($_POST["FIDMotor"]) && intval($_POST["FIDMotor"])>0) {
			$arr_sqlW[] = "tbl_bestellungen.FIDMotor='" . $_POST["FIDMotor"] . "'";
		}

		if(count($arr_sqlW)>0) {
			$sql.= "
				WHERE(" . implode(" AND ",$arr_sqlW) . ")
			";
		}
	}
	
	$sql.= '
		ORDER BY tbl_bestellungen.DatumBestellung DESC
	';
	
	$bestellungen = $conn->query($sql) or tdie("Fehler in der Query: " . $conn->error . '<br>' . $sql);
	while($bestellung = $bestellungen->fetch_object()) {
		if(!isset($bestellung->preisBeleuchtung)) { $bestellung->preisBeleuchtung = 0; }
		$preis = $bestellung->preisRahmentyp + $bestellung->preisMotor + $bestellung->preisBremse + $bestellung->preisBeleuchtung;
		
		if(strlen($bestellung->bezBeleuchtung)==0) { $bestellung->bezBeleuchtung = "(keine)"; }
		echo('
			<article>
				<header>
					<p>Bestelldatum: ' . date("j.n.Y",strtotime($bestellung->DatumBestellung)) . '</p>
					<p>Preis: EUR ' . $preis . '</p>
				</header>
				<ul>
					<li>Rahmentyp: ' . $bestellung->bezRahmentyp . '</li>
					<li>Farbe: ' . $bestellung->bezFarbe . '</li>
					<li>Motor: ' . $bestellung->bezMotor . '</li>
					<li>Bremse: ' . $bestellung->bezBremse . '</li>
					<li>Beleuchtung: ' . $bestellung->bezBeleuchtung . '</li>
				</ul>
			</article>
		');
	}
	?>
</body>
</html>