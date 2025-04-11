<?php
include '../connection.php';
$id_depense=$_GET['id_depense'];
if(isset($_POST['libelle_depense']) && isset($_POST['date_depense']) && isset($_POST['montant_depense']) && isset($_POST['raison_depense'])){
    $libelle_depense=$_POST['libelle_depense'];
    $date_depense=$_POST['date_depense'];
    $montant_depense=$_POST['montant_depense'];
    $raison_depense=$_POST['raison_depense'];
    $preparation=$connect->prepare('UPDATE depense SET libelle_depense=?,date_depense=?,montant_depense=?,raison_depense=? 
    WHERE id_depense=?');
    $preparation->bind_param('ssisi',$libelle_depense,$date_depense,$montant_depense,$raison_depense,$id_depense);
    $preparation->execute();
    header('location:liste_depenses.php?status=Expense modified successfully');
}
?>