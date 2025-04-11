<?php
include_once '../connection.php';
    $id_article=$_GET['id_article'];
$del=mysqli_query($connect,'DELETE FROM commande_article WHERE id_article="'.$id_article.'"');
//  var_dump($del);
header('location:form_ajout_commande_article.php');
?>