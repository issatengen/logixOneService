<?php
include '../connection.php';
$appel=mysqli_query($connect,'SELECT MAX(id_categorie) AS previous_id FROM categorie');
foreach($appel as $ids){
    $previous_id=$ids['previous_id'].' ';
}
$id_categorie=$previous_id+1;
$nom_categorie=$_POST['nom_categorie'];
$description_categorie=$_POST['description_categorie'];
$ajout_categorie=mysqli_query($connect,'INSERT 
INTO categorie(nom_categorie,id_categorie,description_categorie) 
VALUES("'.$nom_categorie.'","'.$id_categorie.'","'.$description_categorie.'")');
header('location:liste_categories.php');
?>