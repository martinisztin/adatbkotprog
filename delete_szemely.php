<?php 
include_once('use/u_dao.php');

if(isset($_GET['id'])) {

    $res = szemely_torles($_GET['id']);

    if($res) {
        header('location: szemelyzet.php');
    }
    else {
        echo "Hiba történt a törlés során! <a href='szemelyzet.php'>Vissza</a>";
    }
}



?>