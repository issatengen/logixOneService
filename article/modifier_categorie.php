<?php
include_once '../connection.php';
$id_categorie=$_GET['id_categorie'];
$nom_categorie=$_POST['nom_categorie'];
$description_categorie=$_POST['description_categorie'];
$modif_categorie=mysqli_query($connect,'UPDATE categorie SET nom_categorie="'.$nom_categorie.'",description_categorie="'.$description_categorie.'" WHERE id_categorie="'.$id_categorie.'"');
// var_dump($modif_categorie);
header ('location:liste_categories.php');
?>