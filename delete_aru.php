<?php 
include_once('use/u_dao.php');

if(isset($_GET['id'])) {

    $res = aru_torles($_GET['id']);

    if($res) {
        header('location: aruk.php');
    }
    else {
        echo "Hiba történt a törlés során! <a href='aruk.php'>Vissza</a>";
    }
}


?>