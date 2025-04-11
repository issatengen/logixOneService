<?php
include_once '../connection.php';
if(isset($_GET['date_x']) and isset($_GET['date_y'])){
    $date_x=$_GET['date_x'];
    $date_y=$_GET['date_y'];
    $clt=mysqli_query($connect,"SELECT nom_client,prenom_client,COUNT(cni_client) as nbre_cmd
    FROM client
    JOIN commande ON client.id_client=commande.id_client 
    AND date_depot BETWEEN '$date_x' AND '$date_y'
    GROUP BY nom_client
    ORDER BY COUNT(cni_client) DESC ");

}else{
    $clt=mysqli_query($connect,"SELECT nom_client,prenom_client,COUNT(cni_client) as nbre_cmd
    FROM client
    JOIN commande ON client.id_client=commande.id_client 
    GROUP BY nom_client
    ORDER BY COUNT(cni_client) DESC ");

}
$excel="";
$excel .="Nom_client\tPrenom_client\tNombre_commandes";
foreach($clt as $le_clt){
    $excel .="{$le_clt['nom_client']}\t{$le_clt['prenom_client']}\t{$le_clt['nbre_cmd']}";
}
header('content-type: application/xls');
header('content-disposition:attachment; filename=rapport_client.xls');
print $excel;
exit;
?>