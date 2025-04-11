<?php
session_start();
include_once '../connection.php';
$code=$_SESSION['code'];
$user=mysqli_query($connect,'SELECT id_utilisateur FROM utilisateur WHERE code_utilisateur="'.$code.'"');
foreach($user as $user_id){
    $id_utilisateur=$user_id['id_utilisateur'];
}
if(isset($_POST['code_promotion']) and isset($_POST['libelle_promotion']) and isset($_POST['date_debut_promo']) and isset($_POST['date_fin_promo'])){
    $code_promotion=$_POST['code_promotion'];
    $libelle_promotion=$_POST['libelle_promotion'];
    $date_debut_promo=$_POST['date_debut_promo'];
    $date_fin_promo=$_POST['date_fin_promo'];

    $add_promo=mysqli_query($connect,'INSERT INTO 
    promotion(code_promotion,libelle_promotion,date_debut_promo,date_fin_promo,id_utilisateur) 
    VALUES("'.$code_promotion.'","'.$libelle_promotion.'","'.$date_debut_promo.'","'.$date_fin_promo.'","'.$id_utilisateur.'")');
    header('location:ligne_promotion.php');
}
?>