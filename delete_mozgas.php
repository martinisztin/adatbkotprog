<?php 
include_once('use/u_dao.php');

if(isset($_GET['id'])) {

    $res = mozgas_torles($_GET['id']);

    if($res) {
        header('location: mozgas.php');
    }
    else {
        echo "Hiba történt a törlés során! <a href='mozgas.php'>Vissza</a>";
    }
}



?>