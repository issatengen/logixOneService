<?php
$id_commande=$_GET['id_commande'];
if(isset($_POST['date_facture']) AND isset($_POST['montant_total']) AND isset ($_POST['montant_verse'])){
    $date_facture=$_POST['date_facture'];
    $montant_total=$_POST['montant_total'];
    $montant_verse=$_POST['montant_verse'];
    $code_fact=$_POST['code_facture'];
    $reduction=$_POST['reduction'];
    $reste=$montant_total-($montant_verse+$reduction);
    include_once '../connection.php';
    $appel='SELECT MAX(id_facture) as maxId FROM facture';
    $maxId=mysqli_query($connect, $appel);
    while($thisId=mysqli_fetch_assoc($maxId)){
        $theId=$thisId['maxId'];
    }
    $code_facture=$code_fact.''. $theId;
    $add=mysqli_query($connect,'INSERT INTO facture(code_facture,date_facture,montant_total,montant_verse,id_commande,reste,reduction) 
    VALUES("'.$code_facture.'","'.$date_facture.'","'.$montant_total.'","'.$montant_verse.'","'.$id_commande.'","'.$reste.'","'.$reduction.'")');
    // var_dump($add);
    header('location:liste_factures.php?');

}else{
    header('location:form_ajout_facture.php');
}
?>