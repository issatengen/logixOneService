<?php
$id_client=$_GET['id_client'];

echo $id_client;
include '../connection.php';
$call_costumer=mysqli_query($connect,'SELECT nom_client,prenom_client FROM client WHERE id_client="'.$id_client.'" ');
foreach($call_costumer as $this_costumer){
    $costumer_name=$this_costumer['nom_client'];
    $costumer_lastName=$this_costumer['prenom_client'];
}
$del=mysqli_query($connect,'DELETE FROM client WHERE id_client="'.$id_client.'"');
// var_dump($del);
// code writen on 17/08/2024
if($del){
    header('location:liste_clients.php?status=Catégorie supprimé avec succès');
}else{
    header("location:liste_clients.php?status=Ce client n'a pas été supprimé
    car il existe des commandes enregistrer au nom de ce dernier. Pour que cette suppression soit effective veillez dabord supprimer les commandes
    de client \"$costumer_name $costumer_lastName\" ");
}

?>