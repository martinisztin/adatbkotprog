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
	return $res;
	
}

function aru_szerkesztese($id, $marka, $nev, $beszerzesi_ar, $szin, $raktar_azonosito) {
	if (!($db = db_kapcsolat())) {
		return false;
	}
	
	$q = "UPDATE aru
	SET marka = '$marka', nev = '$nev', beszerzesi_ar = '$beszerzesi_ar', szin = '$szin', raktar_azonosito = '$raktar_azonosito'
	WHERE azonosito = '$id'";

	$res = mysqli_query($db, $q);
		
	mysqli_close($db);
	return $res;
}

function mozgas_szerkesztese($id, $aru_azonosito, $hova, $irany, $mennyiseg, $mikor, $felugyelo_szigszam) {
	
	
	if (!($db = db_kapcsolat())) {
		return false;
	}
	
	$q = "UPDATE mozgas
	SET aru_azonosito = '$aru_azonosito', hova = '$hova', irany = '$irany', mennyiseg = '$mennyiseg', mikor = '$mikor', felugyelo_szigszam = '$felugyelo_szigszam'
	WHERE nyugta = '$id'";

	$res = mysqli_query($db, $q);
		
	mysqli_close($db);
	return $res;
	
}

function keszlet_szerkesztese($aru_azonosito, $mennyiseg, $kovetkezo_erkezes) {
	
	if(!($db = db_kapcsolat())) {
		return false;
	}

	$q = "UPDATE keszlet
	SET mennyiseg = '$mennyiseg', kovetkezo_erkezes = '$kovetkezo_erkezes'
	WHERE aru_azonosito = '$aru_azonosito'";

	$res = mysqli_query($db, $q);

	mysqli_close($db);
	return $res;
}

function raktar_szerkesztese($azonosito, $orszag, $varos, $irsz, $utca, $hazszam, $kapacitas) {
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "UPDATE raktar
	SET orszag = '$orszag', varos = '$varos', irsz = '$irsz', utca = '$utca', hazszam = '$hazszam', kapacitas = '$kapacitas'
	WHERE azonosito = '$azonosito'";

	$res = mysqli_query($db, $q);

	mysqli_close($db);
	return $res;
}

function szerep_szerkesztese($jogkor_nev, $szemelyzet_szigszam) {
	if(!($db = db_kapcsolat())) {
		return false;
	}

	$q = "UPDATE szerep
	SET jogkor_nev = '$jogkor_nev'
	WHERE szemelyzet_szigszam = '$szemelyzet_szigszam'";

	$res = mysqli_query($db, $q);

	mysqli_close($db);
	return $res;

}

function szemely_szerkesztese($szigszam, $vezeteknev, $keresztnev, $nem, $szulido) {
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "UPDATE szemelyzet
	SET vezeteknev = '$vezeteknev', keresztnev = '$keresztnev', nem = '$nem', szulido = '$szulido'
	WHERE szigszam = '$szigszam'";

	$res = mysqli_query($db, $q);

	mysqli_close($db);
	return $res;
}

function aruk_lekerdez() {
	
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT * FROM aru ORDER BY marka";
	
	$res = mysqli_query($db, $q);
	
	mysqli_close($db);
	return $res;
	
}

function mozgasok_lekerdez() {
	
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT * FROM mozgas ORDER BY mikor";
	
	$res = mysqli_query($db, $q);
	
	mysqli_close($db);
	return $res;
	
}

function raktar_lekerdez() {
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT * FROM raktar ORDER BY azonosito";
	
	$res = mysqli_query($db, $q);
	
	mysqli_close($db);
	return $res;
}

function specific_raktar_lekerdez($id) {
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT * FROM raktar WHERE azonosito = $id ORDER BY azonosito";
	
	$res = mysqli_query($db, $q);
	
	mysqli_close($db);
	return $res;
}

function specific_mozgas_lekerdez($id) {
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT * FROM mozgas WHERE nyugta = $id ORDER BY mikor";
	
	$res = mysqli_query($db, $q);
	
	mysqli_close($db);
	return $res;
}

function specific_szemely_lekerdez($id) {
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT * FROM szemelyzet WHERE szigszam = '$id' ORDER BY vezeteknev, keresztnev";
	
	$res = mysqli_query($db, $q);
	
	mysqli_close($db);
	return $res;
}

function specific_aru_lekerdez($id) {
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT * FROM aru WHERE azonosito = $id ORDER BY marka";
	
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

function szemely_torles($id) {
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT COUNT(*) FROM szerep
	INNER JOIN szemelyzet ON szemelyzet.szigszam = szerep.szemelyzet_szigszam
	WHERE szemelyzet.szigszam = '$id'";

	$returnacio = mysqli_fetch_assoc(mysqli_query($db, $q));

	if($returnacio > 0) {
		$q = "DELETE FROM szerep
		WHERE szemelyzet_szigszam = '$id'";

		mysqli_query($db, $q);
	}

	$q = "DELETE FROM szemelyzet WHERE szigszam = '$id'";

	$res = mysqli_query($db, $q);
	
	mysqli_close($db);
	return $res;
}

function idei_erkezo_marka_statisztika() {
	if (!($db = db_kapcsolat())) {
		return false;
	}

	//2022-ben még érkező áruk márka szerint 
	$q = "SELECT marka, COUNT(*) AS darab FROM aru 
	INNER JOIN keszlet ON aru.azonosito = keszlet.aru_azonosito
	WHERE YEAR(keszlet.kovetkezo_erkezes) = 2022
	GROUP BY marka";

	$res = mysqli_query($db, $q);
	
	mysqli_close($db);
	return $res;
}

function legeladottabb_marka() {
	if (!($db = db_kapcsolat())) {
		return false;
	}

	//legtöbbet kifele mozgó áru
	$q = "SELECT marka, nev, SUM(mozgas.mennyiseg) as eladas FROM aru 
	INNER JOIN mozgas ON aru.azonosito = mozgas.aru_azonosito
	WHERE mozgas.irany = 'kifele'
	GROUP BY marka
	ORDER BY eladas DESC
	LIMIT 1";

	$res = mysqli_query($db, $q);
	
	mysqli_close($db);
	return $res;
}

function szerep_torles($id) {
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "DELETE FROM szerep WHERE szemelyzet_szigszam = '$id'";

	$res = mysqli_query($db, $q);
	
	mysqli_close($db);
	return $res;
}


function szemelyek_lekerdez() {
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT * FROM szemelyzet ORDER BY vezeteknev, keresztnev";
	
	$res = mysqli_query($db, $q);
	
	mysqli_close($db);
	return $res;
}

function szemely_hozzaadasa($szigszam, $vezeteknev, $keresztnev, $nem, $szulido, $image) {
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "INSERT INTO szemelyzet (szigszam, vezeteknev, keresztnev, nem, szulido, image)
	VALUES ('$szigszam', '$vezeteknev', '$keresztnev', '$nem', '$szulido', '$image')";

	$res = mysqli_query($db, $q);

	mysqli_close($db);
	return $res;
}

function szerep_lekerdez($id) {
	if (!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT * FROM szerep WHERE szemelyzet_szigszam = '$id' ORDER BY jogkor_nev";
	
	$res = mysqli_query($db, $q);
	
	mysqli_close($db);
	return $res;
}

function mozgas_hozzaadasa($aru_azonosito, $hova, $irany, $mennyiseg, $mikor, $felugyelo_szigszam) {
	
	
	if (!($db = db_kapcsolat())) {
		return false;
	}
	
	$q = "INSERT INTO mozgas (aru_azonosito, hova, irany, mennyiseg, mikor, felugyelo_szigszam)
	VALUES ('$aru_azonosito', '$hova', '$irany', '$mennyiseg', '$mikor', '$felugyelo_szigszam')";

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

function szerep_hozzaadasa($jogkor_nev, $szemelyzet_szigszam) {
	if(!($db = db_kapcsolat())) {
		return false;
	}

	$q = "INSERT INTO szerep (jogkor_nev, szemelyzet_szigszam)
	VALUES ('$jogkor_nev', '$szemelyzet_szigszam')";

	$res = mysqli_query($db, $q);

	mysqli_close($db);
	return $res;

}

function jogkorok_lekerdez() {
	if(!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT * FROM jogkor ORDER BY prioritas";

	$res = mysqli_query($db, $q);

	mysqli_close($db);
	return $res;
}

function beosztatlan_lekerdez() {
	if(!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT * FROM szemelyzet WHERE szigszam NOT IN (SELECT szemelyzet_szigszam FROM szerep)";

	$res = mysqli_query($db, $q);

	mysqli_close($db);
	return $res;
}

function nem_keszletezett_aru_lekerdez() {
	if(!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT * FROM aru WHERE azonosito NOT IN (SELECT aru_azonosito FROM keszlet)";

	$res = mysqli_query($db, $q);

	mysqli_close($db);
	return $res;
}

function feladatok_lekerdez() {
	if(!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT * FROM feladat
	INNER JOIN jogkor
	ON feladat.jogkor_nev = jogkor.nev
	ORDER BY jogkor.prioritas DESC";

	$res = mysqli_query($db, $q);

	mysqli_close($db);
	return $res;
}

function markak_lekerdez() {

	if(!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT DISTINCT marka FROM aru";

	$res = mysqli_query($db, $q);

	mysqli_close($db);
	return $res;
}

function specific_aru_by_marka($marka) {
	if(!($db = db_kapcsolat())) {
		return false;
	}

	$q = "SELECT * FROM aru WHERE marka = '$marka' ORDER BY marka";

	$res = mysqli_query($db, $q);

	mysqli_close($db);
	return $res;
}

function kep_szerkesztes($id, $kep) {
	if(!($db = db_kapcsolat())) {
		return false;
	}

	$q = "UPDATE szemelyzet
	SET image = '$kep'
	WHERE szigszam = '$id'";

	$res = mysqli_query($db, $q);

	mysqli_close($db);
	return $res;
}