<?php
include '../connection.php';
$client=mysqli_query($connect,'SELECT * FROM client');
$excel="";
$excel .="CNI\tNom\tPrenom\tAdresse\tTelephone";
foreach($client as $clt){
    $excel .="
    {$clt['cni_client']}\t{$clt['nom_client']}\t{$clt['prenom_client']}\t{$clt['adresse_client']}\t{$clt['tel_client']}";
}
header('content-type: application/xls');
header('content-disposition: attachment; filename=listeClient.xls');
print $excel;
exit;
?>