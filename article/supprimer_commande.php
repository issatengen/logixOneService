<?php
include '../connection.php';
$id_commande=$_GET['id_commande'];
$supprimer=mysqli_query($connect,'DELETE FROM commande_article WHERE id_commande="'.$id_commande.'"');
$sup=mysqli_query($connect,'DELETE FROM commande WHERE id_commande="'.$id_commande.'"');
$supp=mysqli_query($connect,'DELETE FROM facture WHERE id_commande="'.$id_commande.'"');
// var_dump($supprimer);
header ('location:liste_commandes.php');
if($del){
    header('location:liste_commandes.php?status=Commande supprimée ainsi que toutes ses factures et ses articles ');
}
?>