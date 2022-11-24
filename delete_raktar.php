<?php 
include_once('use/u_dao.php');

if(isset($_GET['id'])) {

    $res = raktar_torles($_GET['id']);

    if($res) {
        header('location: raktar.php');
    }
    else {
        echo "Hiba történt a törlés során! <a href='raktar.php'>Vissza</a>";
    }
}



?>