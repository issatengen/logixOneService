<?php
// include_once 'modal_supprimer.php';
include '../connection.php';
$id_article=$_GET['id_article'];
$call_item=mysqli_query($connect,'SELECT designation FROM article WHERE id_article="'.$id_article.'"');
foreach($call_item as $this_item){
    $item=$this_item['designation'];
}
$del=mysqli_query($connect,'DELETE FROM article WHERE id_article="'.$id_article.'"');
// var_dump($supprimer);
header('location:liste_articles.php');
// code writen on 17/08/2024
if($del){
    header('location:liste_articles.php?status=Article supprimé avec succès');
}else{
    header("location:liste_articles.php?status=Cet article n'a pas été supprimé
    car il existe des commandes contenant cet article. Pour que cette suppression soit effective veillez dabord supprimer les commandes
    l'articcle \"$item\" ");
}

?>