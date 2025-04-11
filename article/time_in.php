<?php
session_start();
$code=$_SESSION['code'];
date_default_timezone_set('Africa/Douala');
include '../connection.php';
// $user=mysqli_query($connect,'SELECT id_utilisateur FROM utilisateur WHERE code_utilisateur="'.$code.'" ');
$date_presence=date('Y-m-d');
$heure_entree=date('H:i:s');
if(isset($_GET['id_utilisateur'])){
    $user_id=$_GET['id_utilisateur'];
    $timeIn=mysqli_query($connect,'INSERT INTO registre_presence(date_presence,heure_entree,id_utilisateur) 
    VALUES("'.$date_presence.'","'.$heure_entree.'","'.$user_id.'")');
}
var_dump($timeIn);
if($timeIn){
    header('location:dashboard.php?status=Time In registered successfully && id_utilisateur="'.$user_id.'" ');
}else{
    header('location:dashboard.php?status=Time In wasn\'t registered ');
}
?>