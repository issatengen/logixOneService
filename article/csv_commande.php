<?php
include_once '../connection.php';
if(isset($_GET['date_x']) and isset($_GET['date_y'])){
    $date_x=$_GET['date_x'];
    $date_y=$_GET['date_y'];
    $rap_cmd=mysqli_query($connect,"SELECT date_depot,
    SUM(montant_verse) as montant, 
    SUM(reste) as restant, 
    SUM(reduction) as reduction, 
    COUNT(date_depot) as nbre_cmd 
    FROM commande 
    JOIN facture ON commande.id_commande=facture.id_commande 
    AND date_depot BETWEEN '$date_x' AND '$date_y' 
    GROUP BY date_depot ");
}else{
    echo " ";
    $rap_cmd=mysqli_query($connect,"SELECT date_depot,
    SUM(montant_verse) as montant, 
    SUM(reste) as restant, 
    SUM(reduction) as reduction, 
    COUNT(date_depot) as nbre_cmd 
    FROM commande 
    JOIN facture ON commande.id_commande=facture.id_commande
    GROUP BY date_depot ");
}
// initialisation d'une chaine vide
$excel="";
// création des colonnes dans la chaine
// Chaque colonne est séparrée par le symbol de la tabulation (\t)
$excel .="Date_depot\tEncaissements\tRestes\tReductions\tNbreCMD";
// Insertion des variables dans les colonnes
foreach($rap_cmd as $cmd_rap){
    // les accolades ici permettent de créer des ligne et \n permet d'aller à la nouvelle ligne
    $excel .="
    {$cmd_rap['date_depot']}\t{$cmd_rap['montant']}\t{$cmd_rap['restant']}\t{$cmd_rap['reduction']}\t{$cmd_rap['nbre_cmd']}";
}
// Indique au protocole HTTP que le contenu voulu est un fichier au format Excel
header("content-type: application/csv");

// Permet de nommer le fichier et de donner l'extension sinon on enregistre un fichier de type texte php
header("content-disposition: attachment; filename=rapport_commandes.xls");

print $excel;
exit;

?>