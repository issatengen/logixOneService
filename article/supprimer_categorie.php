<?php
$id_categorie=$_GET['id_categorie'];
include_once '../connection.php';
// appel de la catégorie
$appel=mysqli_query($connect,'SELECT * FROM categorie WHERE id_categorie="'.$id_categorie.'"');
foreach($appel as $nom_categorie){
    $nom_cat=$nom_categorie['nom_categorie'];
}
$supprimer=mysqli_query($connect,'DELETE FROM categorie WHERE id_categorie="'.$id_categorie.'"');
if($supprimer){
    header('location:liste_categories.php?status=Catégorie supprimé avec succès');
}else{
    header("location:liste_categories.php?status=La catégorie n'a pas été supprimée 
    car il existe des article dans celle-ci.Pour que cette suppression soit effective veillez dabord supprimer les article 
    de la catégorie $nom_cat");
}
?>