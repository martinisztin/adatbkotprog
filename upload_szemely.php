<?php

include_once("use/u_dao.php");

function kepfeltoltes($alias) {
	$megengedettFormat = array('jpg', 'png');
	$kiterjesztes = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
	if(in_array($kiterjesztes, $megengedettFormat)) {
		$feltoltottFajl = 'img/' . $alias;
		move_uploaded_file($_FILES['image']['tmp_name'], $feltoltottFajl);
	}
	else {
		echo "Hiba a kép feltöltésekor! <a href='szemelyzet.php'>Vissza</a>";
	}
}

$szigszam = $_POST['szigszam'];
$vezeteknev = $_POST['vezeteknev'];
$keresztnev = $_POST['keresztnev'];
$nem = $_POST['nem'];
$szulido = $_POST['szulido'];
$image = $_FILES['image']['name'];


if ( !empty($szigszam) && !empty($vezeteknev) && 
	!empty($keresztnev) && !empty($nem) && !empty($szulido) ) {
    
    $nem = $nem == "ferfi" ? true : false;
    

    $res = szemely_hozzaadasa($szigszam, $vezeteknev, $keresztnev, $nem, $szulido, $image);
	
	if($res) {		
		kepfeltoltes($image);
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
