<?php

include_once("use/u_dao.php");

$aru_azonosito = $_POST['aru_azonosito'];
$mennyiseg = $_POST['mennyiseg'];
$kovetkezo_erkezes = $_POST['kovetkezo_erkezes'];

if (!empty($aru_azonosito) && !empty($mennyiseg) && !empty($kovetkezo_erkezes)) {

	$res = keszlet_hozzaadasa($aru_azonosito, $mennyiseg, $kovetkezo_erkezes);
	
    if($res) {
		header("Location: keszlet.php");
	}
	else {
		echo "Hiba a feltöltéskor! <a href='keszlet.php'>Vissza</a>"
	}
	

} else {
	echo "Állíts be minden értéket! <a href='keszlet.php'>Vissza</a>";
	die;
}

?>
