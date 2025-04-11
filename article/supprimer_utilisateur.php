<?php
include '../connection.php';
$id_utilisateur=$_GET['id_utilisateur'];
$call_user=mysqli_query($connect,'SELECT * FROM utilisateur WHERE id_utilisateur="'.$id_utilisateur.'"');
foreach($call_user as $this_user){
    $user_name=$this_user['nom_utilisateur'];
    $user_lastname=$this_user['prenom_utilisateur'];
}
$del_util=mysqli_query($connect,'DELETE FROM utilisateur WHERE id_utilisateur="'.$id_utilisateur.'" ');
// var_dump($del_util);
if($del_util){
    header('location:liste_utilisateurs.php?status=Catégorie supprimé avec succès');
}else{
    header("location:liste_utilisateurs.php?status=Cet utilisateur n'a pas été supprimé
    car il existe des commandes enregistrer par ce dernier.Pour que cette suppression soit effective veillez dabord supprimer les commandes
    enregistrées par \"$user_name $user_lastname\" ");
}
?>