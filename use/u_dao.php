<?php

function db_kapcsolat() {

	$host = "localhost";
	$uname = "root";
	$database = "raktar";
	
	
	$db = mysqli_connect($host, $uname, "", $database);

	if(!$db) {
		die("Adatbázis hiba.");
	}

	mysqli_set_charset($db, 'utf8');
	
	return $db;
	
}

function aru_hozzaadasa($marka, $nev, $beszerzesi_ar, $szin, $raktar_azonosito) {
	
	
	if (!($db = db_kapcsolat())) {
		return false;
	}
	
	$q = "INSERT INTO aru (marka, nev, beszerzesi_ar, szin, raktar_azonosito)
	VALUES ('$marka', '$nev', '$beszerzesi_ar', '$szin', '$raktar_azonosito')";

	$res = mysqli_query($db, $q);
		
	mysqli_close($db);
	return $sikeres;
	
}

function aruk_lekerdez() {
	
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT * FROM aru";
	
	$res = mysqli_query($db, $q);
	
	mysqli_close($db);
	return $res;
	
}

function mozgasok_lekerdez() {
	
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT * FROM mozgas";
	
	$res = mysqli_query($db, $q);
	
	mysqli_close($db);
	return $res;
	
}

function raktar_letrehozasa($orszag, $varos, $irsz, $hazszam, $kapacitas) {
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "INSERT INTO raktar (orszag, varos, irsz, hazszam, kapacitas)
	VALUES ('$orszag', '$varos', '$irsz', '$hazszam', '$kapacitas')";

	$res = mysqli_query($db, $q);

	mysqli_close($db);
	return $res;
}

function raktar_lekerdez() {
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT * FROM raktar";
	
	$res = mysqli_query($db, $q);
	
	mysqli_close($db);
	return $res;
}

function specific_raktar_lekerdez($id) {
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT * FROM raktar WHERE azonosito = $id";
	
	$res = mysqli_query($db, $q);
	
	mysqli_close($db);
	return $res;
}

function specific_szemely_lekerdez($id) {
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT * FROM szemelyzet WHERE szigszam = '$id'";
	
	$res = mysqli_query($db, $q);
	
	mysqli_close($db);
	return $res;
}

function specific_aru_lekerdez($id) {
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT * FROM aru WHERE azonosito = $id";
	
	$res = mysqli_query($db, $q);
	
	mysqli_close($db);
	return $res;
}

function raktar_torles($id) {
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "DELETE FROM raktar WHERE azonosito = $id";

	$res = mysqli_query($db, $q);

	mysqli_close($db);
	return $res;
}

function aru_torles($id) {
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "DELETE FROM aru WHERE azonosito = $id";
	
	$res = mysqli_query($db, $q);
	
	mysqli_close($db);
	return $res;
}

function keszlet_torles($id) {
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "DELETE FROM keszlet WHERE aru_azonosito = $id";
	
	$res = mysqli_query($db, $q);
	
	mysqli_close($db);
	return $res;
}

function szemelyek_lekerdez() {
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT * FROM szemelyzet";
	
	$res = mysqli_query($db, $q);
	
	mysqli_close($db);
	return $res;
}

function mozgas_hozzaadasa($aru_azonosito, $hova, $irany, $mennyiseg, $felugyelo_szigszam) {
	
	
	if (!($db = db_kapcsolat())) {
		return false;
	}
	
	$q = "INSERT INTO mozgas (aru_azonosito, hova, irany, mennyiseg, felugyelo_szigszam)
	VALUES ('$aru_azonosito', '$hova', '$irany', '$mennyiseg', '$felugyelo_szigszam')";

	$res = mysqli_query($db, $q);
		
	mysqli_close($db);
	return $res;
	
}

function raktar_hozzaadasa($orszag, $varos, $irsz, $utca, $hazszam, $kapacitas) {
	
	
	if (!($db = db_kapcsolat())) {
		return false;
	}
	
	$q = "INSERT INTO raktar (orszag, varos, irsz, utca, hazszam, kapacitas)
	VALUES ('$orszag', '$varos', '$irsz', '$utca', '$hazszam', '$kapacitas')";

	$res = mysqli_query($db, $q);
		
	mysqli_close($db);
	return $res;
	
}

function keszlet_lekerdez() {

	if(!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT * FROM keszlet";

	$res = mysqli_query($db, $q);

	mysqli_close($db);
	return $res;
}

function specific_keszlet_lekerdez($id) {

	if(!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT * FROM keszlet WHERE aru_azonosito = '$id'";

	$res = mysqli_query($db, $q);

	mysqli_close($db);
	return $res;
}

function keszlet_hozzaadasa($aru_azonosito, $mennyiseg, $kovetkezo_erkezes) {
	
	if(!($db = db_kapcsolat())) {
		return false;
	}

	$q = "INSERT INTO keszlet (aru_azonosito, mennyiseg, kovetkezo_erkezes)
	VALUES ('$aru_azonosito', '$mennyiseg', '$kovetkezo_erkezes')";

	$res = mysqli_query($db, $q);

	mysqli_close($db);
	return $res;
}


function olvasolistatLeker() {
	
	if ( !($conn = db_kapcsolat()) ) { // ha nem sikerult csatlakozni, akkor kilepunk
		return false;
	}
	
	// elokeszitjuk az utasitast
	$result = mysqli_query( $conn,"SELECT olvasojegy, nev, szuldatum, lakcim FROM OLVASOK");
	
	mysqli_close($conn);
	return $result;
}

function olvasot_beszur($olvasojegy, $nev, $szuldatum, $lakcim) {
	if ( !($conn = db_kapcsolat()) ) { // ha nem sikerult csatlakozni, akkor kilepunk
		return false;
	}
	
	
	// elokeszitjuk az utasitast
	$stmt = mysqli_prepare( $conn,"INSERT INTO OLVASOK(olvasojegy, nev, szuldatum, lakcim) VALUES (?, ?, ?, ?)");
	
	// bekotjuk a parametereket (igy biztonsagosabb az adatkezeles)
	mysqli_stmt_bind_param($stmt, "dsss", $olvasojegy, $nev, $szuldatum, $lakcim);
	
	// lefuttatjuk az SQL utasitast
	$sikeres = mysqli_stmt_execute($stmt); 
		// ez logikai erteket ad vissza, ami megmondja, hogy sikerult-e 
		// vegrehajtani az utasitast 
		
	mysqli_close($conn);
	return $sikeres;
	
}


function szabad_konyveket_listaz() {
	
	if ( !($conn = db_kapcsolat()) ) { // ha nem sikerult csatlakozni, akkor kilepunk
		return false;
	}
	
	// elokeszitjuk az utasitast
	$result = mysqli_query( $conn,"SELECT konyvszam, CONCAT(konyvszam, ' - ', szerzo, ': ', cim, '. ', kiado, ' ', ev) AS konyv FROM KONYVEK WHERE olvasojegy IS NULL") or die(mysqli_error($conn));
	
	
	mysqli_close($conn);
	return $result;
}

function kolcsonzott_konyvek_listaja() {
	if ( !($conn = db_kapcsolat()) ) { // ha nem sikerult csatlakozni, akkor kilepunk
		return false;
	}
	
	// elokeszitjuk az utasitast
	$result = mysqli_query( $conn,"SELECT konyvszam, cim, szerzo, kiado, ev, CONCAT(OLVASOK.olvasojegy, ' - ', OLVASOK.nev) AS olvaso FROM KONYVEK, OLVASOK WHERE KONYVEK.olvasojegy = OLVASOK.olvasojegy") or die(mysqli_error($conn));
	
	
	mysqli_close($conn);
	return $result;
}

function kolcsonzest_beszur($konyvszam, $olvasojegy) {
	if ( !($conn = db_kapcsolat()) ) { // ha nem sikerult csatlakozni, akkor kilepunk
		return false;
	}
	
	
	// elokeszitjuk az utasitast
	$stmt = mysqli_prepare( $conn,"UPDATE KONYVEK SET olvasojegy = ? WHERE konyvszam = ?");
	
	
	// bekotjuk a parametereket (igy biztonsagosabb az adatkezeles)
	mysqli_stmt_bind_param($stmt, "ds", $olvasojegy, $konyvszam);
	
	// lefuttatjuk az SQL utasitast
	$sikeres = mysqli_stmt_execute($stmt); 
		// ez logikai erteket ad vissza, ami megmondja, hogy sikerult-e 
		// vegrehajtani az utasitast 
		
	mysqli_close($conn);
	return $sikeres;
}

function kolcsonzes_torlese($konyvszam) {
	if ( !($conn = db_kapcsolat()) ) { // ha nem sikerult csatlakozni, akkor kilepunk
		return false;
	}
	
	
	// elokeszitjuk az utasitast
	$stmt = mysqli_prepare( $conn,"UPDATE KONYVEK SET olvasojegy = NULL WHERE konyvszam = ?");
	
	
	// bekotjuk a parametereket (igy biztonsagosabb az adatkezeles)
	mysqli_stmt_bind_param($stmt, "s", $konyvszam);
	
	// lefuttatjuk az SQL utasitast
	$sikeres = mysqli_stmt_execute($stmt); 
		// ez logikai erteket ad vissza, ami megmondja, hogy sikerult-e 
		// vegrehajtani az utasitast 
		
	mysqli_close($conn);
	return $sikeres;
}