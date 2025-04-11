<?php
session_start();
include_once '../connection.php';
// Calling the user
$user=$connect-> prepare('SELECT id_utilisateur FROM utilisateur WHERE code_utilisateur=?');
$user->bind_param('s',$_SESSION['code']);
$user->execute();
$result=$user->get_result();
while($this_result=$result->fetch_assoc()){
    $id_utilisateur=$this_result['id_utilisateur'];
}
// calling the last bank id
$banque=$connect->prepare('SELECT MAX(id_banque) as id_banque FROM banque');
$banque->execute();
$bankResult=$banque->get_result();
foreach($bankResult as $resultbank){
    $id_banque=$resultbank['id_banque'];
}
// calling the last caisse id
$caisse=$connect->prepare('SELECT MAX(id_caisse) as id_caisse FROM caisse');
$caisse->execute();
$caisseResult=$caisse->get_result();
foreach($caisseResult as $resultCaisse){
    $id_caisse=$resultCaisse['id_caisse'];
}
// generate code
$max_id=$connect->prepare('SELECT MAX(id_recette) as id_recette FROM recette_journaliere');
$max_id->execute();
$result=$max_id->get_result();
while($this_result=$result->fetch_assoc()){
$id_recette=$this_result['id_recette']+1;
}
if(isset($_POST['montant_recette']) and isset($_POST['montant_banque']) and isset($_POST['montant_caisse']) and isset($_POST['date'])){
    $code_recette='INC'.date('m').$id_recette;
    $montant_recette=$_POST['montant_recette'];
    $montant_banque=$_POST['montant_banque'];
    $montant_caisse=$_POST['montant_caisse'];
    $dates=$_POST['date'];
    // For income
    $insert=$connect-> prepare('INSERT INTO recette_journaliere(code_recette,montant_recette,banque,caisse,date_recette,id_utilisateur) 
    VALUES(?,?,?,?,?,?) ');
    $insert->bind_param('siiisi',$code_recette,$montant_recette,$montant_banque,$montant_caisse,$dates,$id_utilisateur);
    $insert->execute();
    // For bank
    $code_banque='BK'. $id_banque;
    $insert=$connect-> prepare('INSERT INTO banque(code_banque,montant_banque,date_banque,id_utilisateur) 
    VALUES(?,?,?,?) ');
    $insert->bind_param('sisi',$code_banque,$montant_banque,$dates,$id_utilisateur);
    $insert->execute();
    // For caisse
    $code_caisse='CS'. $id_caisse;
    $insert=$connect-> prepare('INSERT INTO caisse(code_caisse,montant_caisse,date_caisse,id_utilisateur) 
    VALUES(?,?,?,?) ');
    $insert->bind_param('sisi',$code_caisse,$montant_caisse,$dates,$id_utilisateur);
    $insert->execute();
    header('location:liste_recettes.php');
    // var_dump($insert);
}else{
    echo 'Error';
}
?>