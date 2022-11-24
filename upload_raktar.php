<?php

include_once("use/u_dao.php");

$orszag = $_POST['orszag'];
$varos = $_POST['varos'];
$irsz = $_POST['irsz'];
$utca = $_POST['utca'];
$hazszam = $_POST['hazszam'];
$kapacitas = $_POST['kapacitas'];


if ( !empty($orszag) && !empty($varos) && 
	!empty($irsz) && !empty($utca) && !empty($hazszam) && !empty($kapacitas) ) {

	$res = raktar_hozzaadasa($orszag, $varos, $irsz, $utca, $hazszam, $kapacitas);
	
	if($res) {		
		header("Location: raktar.php");
	}
	else {
		echo "Hiba a feltöltéskor! <a href='raktar.php'>Vissza</a>";
	}
	
} else {
	echo "Állíts be minden értéket! <a href='raktar.php'>Vissza</a>";
	die;
}




?>
