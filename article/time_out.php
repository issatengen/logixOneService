<?php
session_start();
include '../connection.php';
date_default_timezone_set('Africa/Douala');
    $user_id=$_GET['id_utilisateur'];
    $select_id=mysqli_query($connect,'SELECT MAX(id_presence) as attendance_id FROM registre_presence WHERE id_utilisateur = "'.$user_id.'"');
    foreach($select_id as $max_id){
        $max_id_presence=$max_id['attendance_id'];
    }
    $timeOut=mysqli_query($connect,'UPDATE registre_presence SET heure_sortie="'.date('H:i:s').'" 
    WHERE id_presence="'.$max_id_presence.'" ');

    if($timeOut){
        header('location:dashboard.php?status=Time Out registered successfully && id_utilisateur="'.$user_id.'"');
    }else{
        header('location:dasboard.php?status=Time Out wasn\'t registered');
    }
?>