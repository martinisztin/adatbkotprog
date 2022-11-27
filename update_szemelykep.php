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
		die();
	}
}

$szigszam = $_POST['szigszam'];
$image = $_FILES['image']['name'];
var_dump($image);

$res = kep_szerkesztes($szigszam, $image);

if($res) {
    kepfeltoltes($image);
    header('location: szemelyzet.php');
}
else {
    echo "Hiba a kép szerkesztésekor! <a href='szemelyzet.php'>Vissza</a>";
}


?>