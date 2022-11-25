<?php

include_once("use/u_dao.php");

$azonosito = $_POST['azonosito'];
$marka = $_POST['marka'];
$nev = $_POST['nev'];
$beszerzesi_ar = $_POST['beszerzesi_ar'];
$szin = $_POST['szin'];
$raktar_azonosito = $_POST['raktar_azonosito'];

if ( !empty($azonosito) && !empty($marka) && !empty($nev) && 
	!empty($beszerzesi_ar) && !empty($szin) && !empty($raktar_azonosito) ) {

	$res = aru_szerkesztese($azonosito, $marka, $nev, $beszerzesi_ar, $szin, $raktar_azonosito);
	
	if($res) {
		header("Location: aruk.php");
	}
	else {
		echo "Hiba a feltöltéskor! <a href='aruk.php'>Vissza</a>";
	}

	

} else {
	echo "Állíts be minden értéket! <a href='aruk.php'>Vissza</a>";
	die;
}

?>
