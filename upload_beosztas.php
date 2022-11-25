<?php

include_once("use/u_dao.php");

if(!isset($_POST['jogkor_nev']) || !isset($_POST['szemelyzet_szigszam'])) {
    header("Location: beosztas.php");
}

$jogkor_nev = $_POST['jogkor_nev'];
$szemelyzet_szigszam = $_POST['szemelyzet_szigszam'];

if (!empty($jogkor_nev) && !empty($szemelyzet_szigszam)) {

	$res = szerep_hozzaadasa($jogkor_nev, $szemelyzet_szigszam);
	
    if($res) {
		header("Location: beosztas.php");
	}
	else {
		echo "Hiba a feltöltéskor! <a href='beosztas.php'>Vissza</a>";
	}
	

} else {
	echo "Állíts be minden értéket! <a href='beosztas.php'>Vissza</a>";
	die;
}

?>
