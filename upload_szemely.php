<?php

include_once("use/u_dao.php");

$szigszam = $_POST['szigszam'];
$vezeteknev = $_POST['vezeteknev'];
$keresztnev = $_POST['keresztnev'];
$nem = $_POST['nem'];
$szulido = $_POST['szulido'];


if ( !empty($szigszam) && !empty($vezeteknev) && 
	!empty($keresztnev) && !empty($nem) && !empty($szulido) ) {
    
    $nem = $nem == "ferfi" ? true : false;
    

    $res = szemely_hozzaadasa($szigszam, $vezeteknev, $keresztnev, $nem, $szulido);
	
	if($res) {		
		header("Location: szemelyzet.php");
	}
	else {
		echo "Hiba a feltöltéskor! <a href='szemelyzet.php'>Vissza</a>";
	}
	
} else {
	echo "Állíts be minden értéket! <a href='szemelyzet.php'>Vissza</a>";
	die;
}




?>
