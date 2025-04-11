<?php
include_once '../connection.php';
$article=mysqli_query($connect,'SELECT * FROM article 
JOIN categorie ON categorie.id_categorie=article.id_categorie');

$excel="";
$excel .="\tDésignation\tQuantite\tPrix unitaire\tCategorie";
 foreach($article as $list){
    $excel .=mb_convert_encoding("
    {$list['designation']}\t{$list['quantite']}\t{$list['prix_unitaire']}\t{$list['nom_categorie']}",'ISO-8859-1','UTF-8');
 }
 header("content-type: application/xls");
 header("content-disposition: attachment; filename=liste_articles.xls");
 print $excel;
 exit;
?>