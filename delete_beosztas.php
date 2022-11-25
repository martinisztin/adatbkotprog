<?php 
include_once('use/u_dao.php');

if(isset($_GET['id'])) {

    $res = szerep_torles($_GET['id']);

    if($res) {
        header('location: beosztas.php');
    }
    else {
        echo "Hiba történt a törlés során! <a href='beosztas.php'>Vissza</a>";
    }
}



?>