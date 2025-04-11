<?php
include '../connection.php';
$id_utilisateur=$_GET['id_utilisateur'];
$code_utilisateur=$_POST['code_utilisateur'];
$nom_utilisateur=$_POST['nom_utilisateur'];
$prenom_utilisateur=$_POST['prenom_utilisateur'];
$adresse_utilisateur=$_POST['adresse_utilisateur'];
$tel_utilisateur=$_POST['tel_utilisateur'];
$email_utilisateur=$_POST['email_utilisateur'];
$mot_de_passe=$_POST['password_utilisateur'];
$id_role=$_POST['id_role'];

$Ajour=mysqli_query($connect,'UPDATE utilisateur 
SET code_utilisateur="'.$code_utilisateur.'",nom_utilisateur="'.$nom_utilisateur.'",prenom_utilisateur="'.$prenom_utilisateur.'",adresse_utilisateur="'.$adresse_utilisateur.'",tel_utilisateur="'.$tel_utilisateur.'",email_utilisateur="'.$email_utilisateur.'",pass="'.$mot_de_passe.'",id_role="'.$id_role.'" 
WHERE id_utilisateur="'.$id_utilisateur.'"');
header ('location:liste_utilisateurs.php');
// var_dump($Ajour);
?>