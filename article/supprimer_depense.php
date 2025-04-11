<?php
if(isset($_GET['id_depense'])){
    $id_depense=$_GET['id_depense'];
    include_once '../connection.php';
    $del=mysqli_query($connect,'DELETE FROM depense WHERE id_depense="'.$id_depense.'"');
    header('location:liste_depenses.php');
}
if($del){
    header('location:liste_depenses.php?status=Dépense supprimé avec succès');
}
?>