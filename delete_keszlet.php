<?php 
include_once('use/u_dao.php');

if(isset($_GET['id'])) {

    $res = keszlet_torles($_GET['id']);

    if($res) {
        header('location: keszlet.php');
    }
    else {
        echo "Hiba történt a törlés során! <a href='mozgas.php'>Vissza</a>";
    }
}



?>