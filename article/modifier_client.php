<?php
$id_client=$_GET['id_client'];
$cni_client=$_POST['cni_client'];
$nom_client=$_POST['nom_client'];
$prenom_client=$_POST['prenom_client'];
$adresse_client=$_POST['adresse_client'];
$tel_client=$_POST['tel_client'];

include '../connection.php';

$modif=mysqli_query($connect,'UPDATE client SET cni_client="'.$cni_client.'",nom_client="'.$nom_client.'",prenom_client="'.$prenom_client.'",adresse_client="'.$adresse_client.'",tel_client="'.$tel_client.'" WHERE id_client="'.$id_client.'"');
// var_dump($modif);
header('location:liste_clients.php');
?>