<?php
include_once '../connection.php';
if(!empty($_POST['quantite'])){
    $id_article=$_GET['id_article'];
    $quantite=$_POST['quantite'];
    $prix_unitaire=$_POST['prix_unitaire'];
    $montant=$quantite*$prix_unitaire;
    echo $montant;
    $modif=mysqli_query($connect,'UPDATE commande_article 
    SET quantite_art="'.$quantite.'",montant="'.$montant.'",prix_unitaire_art="'.$prix_unitaire.'" WHERE id_article="'.$id_article.'" ');
    header('location:form_ajout_commande_article.php');
}else{
    header ('location:form_modifier_article_commande.php');
}

?>