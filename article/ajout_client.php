<?php
include '../connection.php';
$appel=mysqli_query($connect,'SELECT MAX(id_client) as idClt FROM client');
while($thisID=mysqli_fetch_assoc($appel)){
    $idClt=$thisID['idClt'];
}
$cni_client=$idClt+1;
$nom_client=$_POST['nom_client'];
$prenom_client=$_POST['prenom_client'];
$adresse_client=$_POST['adresse_client'];
$tel_client=$_POST['tel_client'];

// 02-03-2025 
$query='INSERT INTO client(cni_client,nom_client,prenom_client,adresse_client,tel_client) 
VALUES(?,?,?,?,?)';
$add_client=$connect->prepare($query);
$add_client->bind_param('sssss',$cni_client,$nom_client,$prenom_client,$adresse_client,$tel_client);
$add_client->execute();
// var_dump($add_client);
header('location:form_ajout_commande.php');
?>
