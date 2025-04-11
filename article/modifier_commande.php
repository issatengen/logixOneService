<?php
session_start();
if(isset($_SESSION['code'])){
    if(!empty($_SESSION['code'])){
        $code=$_SESSION['code'];
    }
}

include '../connection.php';

$utilisateur=mysqli_query($connect,'SELECT id_utilisateur 
FROM utilisateur WHERE code_utilisateur="'.$code.'" ');
foreach($utilisateur as $id_util){
    $id_utilisateur=$id_util['id_utilisateur'];
}
$id_commande=$_GET['id_commande'];
$id_client=$_POST['id_client'];
$date_depot=$_POST['date_depot'];
$date_estimatrice=$_POST['date_estimatrice'];
$date_retrait=$_POST['date_retrait'];
$modif=mysqli_query($connect,'UPDATE commande 
SET date_depot="'.$date_depot.'",date_estimatrice="'.$date_estimatrice.'",date_retrait="'.$date_retrait.'",id_client="'.$id_client.'",id_utilisateur="'.$id_utilisateur.'" 
WHERE id_commande="'.$id_commande.'"');
// var_dump($modif);
header ('location:liste_factures.php');
?>