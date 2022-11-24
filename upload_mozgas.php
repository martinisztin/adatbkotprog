<?php

include_once("use/u_dao.php");

$aru_azonosito = $_POST['aru_azonosito'];
$hova = $_POST['hova'];
$irany = $_POST['irany'];
$mennyiseg = $_POST['mennyiseg'];
$felugyelo_szigszam = $_POST['felugyelo_szigszam'];


if ( !empty($aru_azonosito) && !empty($hova) && 
	!empty($irany) && !empty($mennyiseg) && !empty($felugyelo_szigszam) ) {

	$res = mozgas_hozzaadasa($aru_azonosito, $hova, $irany, $mennyiseg, $felugyelo_szigszam);
	
	if($res) {		
		header("Location: mozgasok.php");
	}
	else {
		echo "Hiba a feltöltéskor! <a href='mozgasok.php'>Vissza</a>"
	}
	
} else {
	echo "Állíts be minden értéket! <a href='mozgasok.php'>Vissza</a>";
	die;
}




?>
