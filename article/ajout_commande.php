<?php
include '../connection.php';
$date_depot=$_POST['date_depot'];
$date_estimatrice=$_POST['date_estimatrice'];
$code_commande=$_POST['code_commande'];
$id_client=$_POST['id_client'];
$id_utilisateur=$_POST['id_utilisateur'];
$ajout_commande=mysqli_query($connect,'INSERT INTO commande(code_commande,date_depot,date_estimatrice,id_client,id_utilisateur) VALUES("'.$code_commande.'","'.$date_depot.'","'.$date_estimatrice.'","'.$id_client.'","'.$id_utilisateur.'")');
// var_dump($ajout_commande);
header('location:form_ajout_commande_article.php');
?>