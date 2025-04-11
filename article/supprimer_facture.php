<?php
include_once '../connection.php';
$id_facture=$_GET['id_facture'];
$del=mysqli_query($connect,'DELETE FROM facture WHERE id_facture="'.$id_facture.'" ');
var_dump($del);
if($del){
    header('location:liste_factures.php?status=Facture supprimé avec succès');
}
?>