<?php
session_start();
include_once '../connection.php';
$code=$_SESSION['code'];

$appel=mysqli_query($connect,'SELECT id_utilisateur FROM utilisateur WHERE code_utilisateur="'.$code.'" ');
foreach($appel as $user){
    $id_utilisateur=$user['id_utilisateur'];
}
// calling the last caisse id
$caisse=$connect->prepare('SELECT MAX(id_caisse) as id_caisse FROM caisse');
$caisse->execute();
$caisseResult=$caisse->get_result();
foreach($caisseResult as $resultCaisse){
    $id_caisse=$resultCaisse['id_caisse'];
}
$dep=$connect->prepare('SELECT MAX(id_depense) as id_depense FROM depense');
$dep->execute();
$depResult=$dep->get_result();
foreach($depResult as $resultDep){
    $id_depense=$resultDep['id_depense'];
}
$banque=$connect->prepare('SELECT MAX(id_banque) as id_banque FROM banque');
$banque->execute();
$banqueResult=$banque->get_result();
foreach($banqueResult as $resultBanque){
    $id_banque=$resultBanque['id_banque'];
}
if(isset($_POST['code_depense']) and isset($_POST['libelle_depense']) and  isset($_POST['montant_depense']) and  isset($_POST['raison_depense'])){
    $code_depense=$_POST['code_depense'].''. $id_depense;
    $libelle_depense=$_POST['libelle_depense'];
    $montant_depense=$_POST['montant_depense'];
    $raison_depense=$_POST['raison_depense'];
    $date_depense=$_POST['date_depense'];
    $img_depense=$_FILES['image_depense']['name'];
    $img_tmp_name=$_FILES['image_depense']['tmp_name'];
    $extension=pathinfo($img_depense,PATHINFO_EXTENSION);
    $image_depense=uniqid('img_',true).'.'. $extension;
    $destination='../images/image_depense/'.$image_depense;
    echo $image_depense;
    move_uploaded_file($img_tmp_name,$destination);
    $query='INSERT INTO depense(code_depense,libelle_depense,montant_depense,raison_depense,id_utilisateur,date_depense,image_depense) 
    VALUES(?,?,?,?,?,?,?)';
    $insert=$connect->prepare($query);
    $insert->bind_param('ssisiss',$code_depense, $libelle_depense, $montant_depense, $raison_depense, $id_utilisateur, $date_depense, $image_depense);
    $insert->execute();
}else{
    echo 'Aucune variable retrouvée!!';
}

    $code_caisse='CS'. $id_caisse;
    $code_banque='BK'. $id_banque;
    $montant_caisse=-$montant_depense;
    $montant_banque=-$montant_depense;
    if(isset($_SESSION['max_exp_caisse'])){
        $maxExp=$_SESSION['max_exp_caisse'];
    }
    // if($montant_caisse<=$maxExp){
    //     $insert=$connect-> prepare('INSERT INTO caisse(code_caisse,montant_caisse,date_caisse,id_utilisateur)
    //     VALUES(?,?,?,?) ');
    //     $insert->bind_param('sisi',$code_caisse,$montant_caisse,$date_depense,$id_utilisateur);
    //     $insert->execute();
    // }else{
    //     $insertBank=$connect->prepare('INSERT INTO banque(code_banque,montant_banque,date_banque,id_utilisateur) 
    //     VALUES(?,?,?,?)');
    //     $insertBank->bind_param('sisi',$code_banque,$montant_banque,$date_depense,$id_utilisateur);
    //     $insertBank->exucute();

    // }
    
//    var_dump($insert);
header('location:liste_depenses.php');

?>