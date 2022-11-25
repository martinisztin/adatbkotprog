<?php

include_once("use/u_dao.php");

$nyugta = $_POST['nyugta'];
$aru_azonosito = $_POST['aru_azonosito'];
$hova = $_POST['hova'];
$irany = $_POST['irany'];
$mennyiseg = $_POST['mennyiseg'];
$mikor = $_POST['mikor'];
$felugyelo_szigszam = $_POST['felugyelo_szigszam'];


if ( !empty($nyugta) && !empty($aru_azonosito) && !empty($hova) && 
	!empty($irany) && !empty($mennyiseg) && !empty($felugyelo_szigszam) ) {

	$res = mozgas_szerkesztese($nyugta, $aru_azonosito, $hova, $irany, $mennyiseg, $mikor, $felugyelo_szigszam);
	
	if($res) {		
		header("Location: mozgasok.php");
	}
	else {
		echo "Hiba a feltöltéskor! <a href='mozgasok.php'>Vissza</a>";
	}
	
} else {
	echo "Állíts be minden értéket! <a href='mozgasok.php'>Vissza</a>";
	die;
}




?>
