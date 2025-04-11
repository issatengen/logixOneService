<?php
include '../connection.php';
if(isset($_POST['code_article']) && isset($_POST['designation']) && isset($_POST['quantite']) && isset($_POST['prix_unitaire']) && isset($_POST['categorie'])){
    $code_article=$_POST['code_article'];
    $designation=$_POST['designation'];
    $quantite=$_POST['quantite'];
    $prix_unitaire=$_POST['prix_unitaire'];
    $id_article=$_GET['id_article'];
    $categorie=$_POST['categorie'];
    $image=$_FILES['image_article']['name'];
    $tmp_name=$_FILES['image_article']['tmp_name'];

    $extension=pathinfo($image,PATHINFO_EXTENSION);
    $image_article=uniqid('img_',true).'.'. $extension;
    $destination='../images/image_article/'. $image_article;
    move_uploaded_file($tmp_name, $destination);
    $modif=mysqli_query($connect,'UPDATE article SET code_article="'.$code_article.'",designation="'.$designation.'",quantite="'.$quantite.'",prix_unitaire="'.$prix_unitaire.'",id_categorie="'.$categorie.'",image_article="'.$image_article.'" WHERE id_article="'.$id_article.'"');
    header('location:liste_articles.php');
}

// echo $code_article." ". $designation." ". $quantite." ". $prix_unitaire." ". $id_article;
// $modif=mysqli_query($connect,'UPDATE article SET code_article="'.$code_article.'",designation="'.$designation.'",quantite="'.$quantite.'",prix_unitaire="'.$prix_unitaire.'",id_categorie="'.$categorie.'" WHERE id_article="'.$id_article.'"');
// // var_dump($modif);

?>