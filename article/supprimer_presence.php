<?php
include_once '../connection.php';
if(isset($_GET['id_presence'])){
    $id_presence=$_GET['id_presence'];
    $del=mysqli_query($connect,'DELETE FROM registre_presence WHERE id_presence="'.$id_presence.'" ');
}
if($del){
    header('location:dashboard.php?status=Facture supprimé avec succès');
}
?>