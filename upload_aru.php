<?php

include_once("use/u_dao.php");

$marka = $_POST['marka'];
$nev = $_POST['nev'];
$beszerzesi_ar = $_POST['beszerzesi_ar'];
$szin = $_POST['szin'];
$raktar_azonosito = $_POST['raktar_azonosito'];

if ( !empty($marka) && !empty($nev) && 
	!empty($beszerzesi_ar) && !empty($szin) && !empty($raktar_azonosito) ) {

	$res = aru_hozzaadasa($marka, $nev, $beszerzesi_ar, $szin, $raktar_azonosito);
	
	if($res) {
		header("Location: aruk.php");
	}
	else {
		echo "Hiba a feltöltéskor!"
	}

	

} else {
	echo "Állíts be minden értéket! <a href='aruk.php'>Vissza</a>";
	die;
}

?>
