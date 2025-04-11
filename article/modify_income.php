<?php
include_once '../connection.php';
if(isset($_GET['id_recette']) and isset($_POST['montant_recette']) and isset($_POST['date_recette'])){
    $id_recette=(int)$_GET['id_recette'];
    $montant_recette=(int)$_POST['montant_recette'];
    $date_recette=date('Y-m-d', strtotime($_POST['date_recette']));
    $update=$connect->Prepare('UPDATE recette_journaliere SET montant_recette=?, date_recette=? WHERE id_recette=?');
    $update->bind_param('isi',$montant_recette, $date_recette, $id_recette);
    $update->execute();
   header('location:liste_recettes.php');
}
?>