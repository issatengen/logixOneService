<?php
include '../connection.php';
if(isset($_POST['designation']) && isset($_POST['quantite']) && isset($_POST['prix_unitaire']) && isset($_POST['categorie'])){
    $code_article='A'. rand(1,10000);
    $designation=$_POST['designation'];
    $quantite=$_POST['quantite'];
    $prix_unitaire=$_POST['prix_unitaire'];
    $categorie=$_POST['categorie'];
    $image=$_FILES['image_article']['name'];
    $tmp_name=$_FILES['image_article']['tmp_name'];

    // new image added on 27/02/2025
    $extension=pathinfo($image, PATHINFO_EXTENSION);
    $image_article=uniqid('img_',true).'.'.$extension;
    $destination='../images/image_article/'. $image_article;
    move_uploaded_file($tmp_name,$destination);
    $query='INSERT INTO article(code_article,designation,quantite,prix_unitaire,image_article,id_categorie) VALUES(?,?,?,?,?,?)';
    $add_db=$connect->prepare($query);
    $add_db->bind_param('ssiisi',$code_article,$designation,$quantite,$prix_unitaire,$image_article,$categorie);
    $add_db->execute();
    if($add_db){
        header("location:liste_articles.php?status=Item added successfully");
    }
}
?>
