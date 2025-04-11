<?php
if(!empty($_POST['montant_total']) and !empty($_POST['id_commande']) and !empty($_POST['date_facture']) and !empty($_POST['code_facture'])){
    $montant_total=$_POST['montant_total'];
    $montant_verse=$_POST['montant_verse'];
    $reste=$montant_total-$montant_verse;
    $id_commande=$_POST['id_commande'];
    $date_facture=$_POST['date_facture'];
    $code_facture=$_POST['code_facture'];
    include_once '../connection.php';
     // echo $id_commande.' '.$montant_total.' '.$montant_verse.' '.$code_facture.' '.$reste.' '.$date_facture;
    $add=mysqli_query($connect,'INSERT INTO facture(code_facture,date_facture,montant_total,montant_verse,id_commande,reste) 
    VALUES("'.$code_facture.'","'.$date_facture.'","'.$montant_total.'","'.$montant_verse.'","'.$id_commande.'","'.$reste.'")');
     // var_dump($add);
    header('location:liste_factures.php');
}else{
    header('location:form_modifier_facture.php');
}
?>