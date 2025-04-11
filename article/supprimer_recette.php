<?php
include_once '../connection.php';
$id_recette=(int)$_GET['id_recette'];
$del=$connect->prepare('DELETE FROM recette_journaliere WHERE id_recette=? ');
$del->bind_param('i',$id_recette);
$del->execute();
var_dump($del);
if($del){
    header('location:liste_recettes.php?status=Recette journalière supprimé avec succès');
}
?>