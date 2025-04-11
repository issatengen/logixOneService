<?php
if(null!==($_POST['quantite']) && null!==($_POST['prix_unitaire'])){
    $quantite=$_POST['quantite'];
    $prix_unitaire=$_POST['prix_unitaire'];
    $id_commande=$_POST['id_commande'];
}
include_once '../connection.php';
$id_article=$_GET['id_article'];
$montant=$quantite*$prix_unitaire;

// $la_commande=mysqli_query($connect,'SELECT * FROM commande ORDER BY id_commande DESC');
// While($cet_commande=mysqli_fetch_assoc($la_commande)){
//     $id_commande=$cet_commande['id_commande'];
// }
$ajouter=mysqli_query($connect,'INSERT INTO commande_article(id_commande,id_article,quantite_art,prix_unitaire_art,montant) VALUES("'.$id_commande.'","'.$id_article.'","'.$quantite.'","'.$prix_unitaire.'","'.$montant.'")');
// var_dump($ajouter);
header ('location:form_ajout_commande_article.php');
?>